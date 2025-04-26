<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   use CrudTrait;

   public function index()
   {
      $items = Mbarang::all();
      $data['items'] = $items;

      return $this->listView('products.index', $data);
   }

   public function create()
   {
      $formfield = Mbarang::query()->findOrNew(-1);
      $data['formfield'] = $formfield;

      return $this->formView('products.form', $data);
   }

   public function show($id)
   {
      $formfield = Mbarang::query()->findOrNew($id);
      $data['formfield'] = $formfield;

      return $this->formView('products.form', $data);
   }

   public function setupForm()
   {
      $param = request()->route()->parameter('product');
      $formfield = Mbarang::query()->findOrNew($param);

      return $formfield;
   }
}
