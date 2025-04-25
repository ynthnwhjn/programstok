<?php

namespace App\Http\Controllers;

use App\Models\Tbelinotah;
use App\Models\Variabel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends CrudController
{
   public function setupList()
   {
      $items = Tbelinotah::query()
         ->with('supplier')
         ->get();

      return $items;
   }

   public function setupForm()
   {
      $param = request()->route()->parameter('purchase_invoice');
      $formfield = Tbelinotah::query()
         ->with([
            'supplier'
         ])
         ->findOrNew($param);

      return $formfield;
   }

   public function store(Request $request)
   {
      DB::beginTransaction();

      $request->merge([
         'tanggal' => Carbon::now(),
      ]);

      try {
         $request->validate([
            'supplier_id' => 'required',
         ]);

         $belinota = new Tbelinotah($request->all());
         $belinota->save();

         $variabel_field = Variabel::query()
            ->where('nama', 'LIKE', 'field%')
            ->get()
            ->pluck('nilai', 'nama');

         DB::commit();

         return redirect()->route('purchase_invoices.show', $belinota);

         // return response()->json([
         //    '_all' => $request->all(),
         //    'variabel' => $variabel_field,
         // ]);
      } catch (\Exception $e) {
         DB::rollBack();

         return back();

         // return response()->json([
         //    'message' => $e->getMessage(),
         // ], 500);
      }
   }

   public function update(Request $request, $id)
   {
      //
   }
}
