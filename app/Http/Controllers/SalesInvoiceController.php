<?php

namespace App\Http\Controllers;

use App\Models\Tjualnotad;
use App\Models\Tjualnotah;
use App\Traits\CrudTrait;
use App\Traits\StokBarangTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesInvoiceController extends Controller
{
   use CrudTrait, StokBarangTrait;

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $items = Tjualnotah::query()
         ->with('customer')
         ->get();

      $data['items'] = $items;

      return $this->listView('sales_invoices.index', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $formfield = Tjualnotah::query()
         ->findOrNew(-1);
      $data['formfield'] = $formfield;

      return $this->formView('sales_invoices.form', $data);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      DB::enableQueryLog();
      DB::beginTransaction();

      if($request->isNotFilled('tanggal')) {
         $request->merge([
            'tanggal' => Carbon::now(),
         ]);
      }

      $subtotal = collect($request->input('sales_invoice_detail'))->sum('subtotal');

      $request->merge([
         'subtotal' => $subtotal,
         'total' => $subtotal,
      ]);

      try {
         $request->validate([
            'customer_id' => 'required',
         ]);

         $jualnota = new Tjualnotah($request->all());
         $jualnota->save();

         $data_stok = [];
         foreach ($request->input('sales_invoice_detail') as $row) {
            $row['subtotal'] = floatval($row['jumlah']) * floatval($row['harga']);

            $jualnotad = new Tjualnotad($row);
            $jualnota->salesInvoiceDetail()->save($jualnotad);

            $data_stok[] = [
               'transaksih_id' => $jualnota->id,
               'transaksid_id' => $jualnotad->id,
               'transaksi_kode' => $jualnota->kode,
               'gudang_id' => 0,
               'barang_id' => $row['barang_id'],
               'jumlah' => floatval($row['jumlah']) * -1,
               'harga' => $row['harga'],
               'jenis_transaksi' => 'JualNota',
               'tanggal' => $jualnota->tanggal,
            ];
         }

         $this->checkStock($data_stok);
         $this->saveStok($data_stok, $jualnota->id, 'JualNota');

         DB::commit();

         return response()->json([
            'item' => $jualnota,
            'redirect' => route('sales_invoices.show', $jualnota),
            '_all' => $request->all(),
            '_debug' => DB::getQueryLog(),
         ]);
      } catch (\Exception $e) {
         DB::rollBack();

         return response()->json([
            'message' => $e->getMessage(),
            'trace' => $e->getTrace(),
            '_all' => $request->all(),
            '_debug' => DB::getQueryLog(),
         ], 500);
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $formfield = Tjualnotah::query()
         ->with([
            'customer',
            'salesInvoiceDetail.barang',
         ])
         ->findOrNew($id);
      $data['formfield'] = $formfield;

      return $this->formView('sales_invoices.form', $data);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      //
   }
}
