<?php

namespace App\Http\Controllers;

use App\Models\Tbelinotad;
use App\Models\Tbelinotah;
use App\Models\Variabel;
use App\Traits\CrudTrait;
use App\Traits\StokBarangTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends Controller
{
   use CrudTrait, StokBarangTrait;

   public function index()
   {
      $items = Tbelinotah::query()
         ->with('supplier')
         ->get();

      $data['items'] = $items;

      return $this->listView('purchase_invoices.index', $data);
   }

   public function create()
   {
      $formfield = Tbelinotah::query()
         ->findOrNew(-1);
      $data['formfield'] = $formfield;

      return $this->formView('purchase_invoices.form', $data);
   }

   public function show($id)
   {
      $formfield = Tbelinotah::query()
         ->with([
            'supplier',
            'purchaseInvoiceDetail.barang',
         ])
         ->findOrNew($id);
      $data['formfield'] = $formfield;

      return $this->formView('purchase_invoices.form', $data);
   }

   public function edit($id)
   {
      $formfield = Tbelinotah::query()
         ->with([
            'supplier',
            'purchaseInvoiceDetail.barang',
         ])
         ->findOrNew($id);
      $data['formfield'] = $formfield;

      return $this->formView('purchase_invoices.form', $data);
   }

   public function store(Request $request)
   {
      DB::enableQueryLog();
      DB::beginTransaction();

      if($request->isNotFilled('tanggal')) {
         $request->merge([
            'tanggal' => Carbon::now(),
         ]);
      }

      $subtotal = collect($request->input('purchase_invoice_detail'))->sum('subtotal');

      $request->merge([
         'subtotal' => $subtotal,
         'total' => $subtotal,
      ]);

      try {
         $request->validate([
            'supplier_id' => 'required',
         ]);

         $belinota = new Tbelinotah($request->all());
         $belinota->save();

         $data_stok = [];
         foreach ($request->input('purchase_invoice_detail') as $row) {
            $row['subtotal'] = floatval($row['jumlah']) * floatval($row['harga']);

            $belinotad = new Tbelinotad($row);
            $belinota->purchaseInvoiceDetail()->save($belinotad);

            $data_stok[] = [
               'transaksih_id' => $belinota->id,
               'transaksid_id' => $belinotad->id,
               'transaksi_kode' => $belinota->kode,
               'gudang_id' => 0,
               'barang_id' => $row['barang_id'],
               'jumlah' => $row['jumlah'],
               'harga' => $row['harga'],
               'jenis_transaksi' => 'BeliNota',
               'tanggal' => $belinota->tanggal,
            ];
         }

         $this->saveStok($data_stok, $belinota->id, 'BeliNota');

         DB::commit();

         return response()->json([
            'item' => $belinota,
            'redirect' => route('purchase_invoices.show', $belinota),
            '_all' => $request->all(),
            '_debug' => DB::getQueryLog(),
         ]);
      } catch (\Exception $e) {
         DB::rollBack();

         return response()->json([
            'message' => $e->getMessage(),
            '_all' => $request->all(),
         ], 500);
      }
   }

   public function update(Request $request, $id)
   {
      DB::enableQueryLog();
      DB::beginTransaction();

      // return response()->json([
      //    '_all' => $request->all(),
      // ], 500);

      $subtotal = collect($request->input('purchase_invoice_detail'))->sum('subtotal');

      $request->merge([
         'subtotal' => $subtotal,
         'total' => $subtotal,
      ]);

      try {
         $request->validate([
            'supplier_id' => 'required',
         ]);

         $belinota = Tbelinotah::query()->findOrFail($id);
         $belinota->update($request->all());

         $ignore_detail_id = collect($request->input('purchase_invoice_detail'))->pluck('id')
            ->filter(function($value) {
               return $value != null;
            })
            ->toArray();

         $belinota->purchaseInvoiceDetail()
            ->whereNotIn('id', $ignore_detail_id)
            ->delete();

         $data_stok = [];
         foreach ($request->input('purchase_invoice_detail') as $row) {
            $row['subtotal'] = floatval($row['jumlah']) * floatval($row['harga']);

            if(isset($row['id'])) {
               $belinotad = Tbelinotad::query()->find($row['id']);
               if($belinotad) {
                  $belinotad->update($row);
               }
            }
            else {
               $belinotad = new Tbelinotad($row);
               $belinota->purchaseInvoiceDetail()->save($belinotad);
            }

            $data_stok[] = [
               'transaksih_id' => $belinota->id,
               'transaksid_id' => $belinotad->id,
               'transaksi_kode' => $belinota->kode,
               'gudang_id' => 0,
               'barang_id' => $row['barang_id'],
               'jumlah' => $row['jumlah'],
               'harga' => $row['harga'],
               'jenis_transaksi' => 'BeliNota',
               'tanggal' => $belinota->tanggal,
            ];
         }

         $this->saveStok($data_stok, $belinota->id, 'BeliNota');

         DB::commit();

         return response()->json([
            'item' => $belinota,
            'ignore_detail_id' => $ignore_detail_id,
            'redirect' => route('purchase_invoices.show', $belinota),
            '_all' => $request->all(),
            '_debug' => DB::getQueryLog(),
         ]);
      } catch (\Exception $e) {
         DB::rollBack();

         return response()->json([
            'message' => $e->getMessage(),
            '_all' => $request->all(),
         ], 500);
      }
   }
}
