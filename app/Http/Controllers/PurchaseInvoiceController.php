<?php

namespace App\Http\Controllers;

use App\Models\Tbelinotah;
use App\Models\Variabel;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends Controller
{
   use CrudTrait;

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
         ->with([
            'supplier'
         ])
         ->findOrNew(-1);
      $data['formfield'] = $formfield;

      return $this->formView('purchase_invoices.form', $data);
   }

   public function show($id)
   {
      $formfield = Tbelinotah::query()
         ->with([
            'supplier'
         ])
         ->findOrNew($id);
      $data['formfield'] = $formfield;

      return $this->formView('purchase_invoices.form', $data);
   }

   public function store(Request $request)
   {
      DB::beginTransaction();

      if($request->isNotFilled('tanggal')) {
         $request->merge([
            'tanggal' => Carbon::now(),
         ]);
      }

      try {
         $request->validate([
            'supplier_id' => 'required',
         ]);

         $belinota = new Tbelinotah($request->all());
         $belinota->save();

         DB::commit();

         return redirect()->route('purchase_invoices.show', $belinota);
      } catch (\Exception $e) {
         DB::rollBack();

         return back();
      }
   }

   public function update(Request $request, $id)
   {
      DB::beginTransaction();

      try {
         $request->validate([
            'supplier_id' => 'required',
         ]);

         $belinota = Tbelinotah::query()->findOrFail($id);
         $belinota->update($request->all());

         DB::commit();

         return redirect()->route('purchase_invoices.show', $belinota);
      } catch (\Exception $e) {
         DB::rollBack();

         return back();
      }
   }
}
