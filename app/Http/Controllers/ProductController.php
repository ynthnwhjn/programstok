<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class ProductController extends CrudController
{
   public function setupList()
   {
      $items = Mbarang::all();

      return $items;
   }

   public function setupForm()
   {
      $param = request()->route()->parameter('product');
      $formfield = Mbarang::query()->findOrNew($param);

      return $formfield;
   }
}
