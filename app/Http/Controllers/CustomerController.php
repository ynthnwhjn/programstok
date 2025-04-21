<?php

namespace App\Http\Controllers;

use App\Models\Mcustsupp;
use Illuminate\Http\Request;

class CustomerController extends CrudController
{
   public function setupList()
   {
      $items = Mcustsupp::query()
         ->where('role', 'Customer')
         ->get();

      return $items;
   }

   public function setupForm()
   {
      $param = request()->route()->parameter('customer');
      $formfield = Mcustsupp::query()->findOrNew($param);

      return $formfield;
   }
}
