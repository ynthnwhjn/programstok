<?php

namespace App\Http\Controllers;

use App\Models\Mcustsupp;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   use CrudTrait;

   public function index()
   {
      $items = Mcustsupp::query()
         ->where('role', 'Customer')
         ->get();

      $data['items'] = $items;

      return $this->listView('customers.index', $data);
   }

   public function create()
   {
      $formfield = Mcustsupp::query()
         ->findOrNew(-1);
      $data['formfield'] = $formfield;

      return $this->formView('customers.form', $data);
   }

   public function show($id)
   {
      $formfield = Mcustsupp::query()
         ->findOrFail($id);
      $data['formfield'] = $formfield;

      return $this->formView('customers.form', $data);
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
