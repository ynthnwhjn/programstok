<?php

namespace App\Http\Controllers;

use App\Models\Tbelinotah;
use Illuminate\Http\Request;

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
}
