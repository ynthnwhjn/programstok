<?php

namespace App\Http\Controllers;

use App\Models\Mcustsupp;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   public function index()
   {
      //
   }

   public function create()
   {
      //
   }

   public function show($id)
   {
      //
   }

   public function update($id)
   {
      //
   }

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
