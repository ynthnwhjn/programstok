<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mbarang;
use App\Models\Mcustsupp;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
   public function supplier()
   {
      $items = Mcustsupp::query()
         ->where('role', 'Supplier')
         ->get();

      return response()->json([
         'items' => $items,
         'output' => $items->pluck('nama', 'id'),
      ]);
   }

   public function barang()
   {
      $items = Mbarang::query()
         ->get();

      return response()->json([
         'items' => $items,
         'output' => $items->pluck('nama', 'id'),
      ]);
   }
}
