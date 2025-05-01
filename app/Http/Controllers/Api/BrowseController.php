<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mbarang;
use App\Models\Mcustsupp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrowseController extends Controller
{
   public function supplier()
   {
      DB::enableQueryLog();

      $items = Mcustsupp::query()
         ->where('role', 'Supplier')
         ->where(function($q) {
            if(request()->filled('keyword')) {
               $q->where('nama', 'LIKE', '%'. request('keyword') .'%');
            }
         })
         ->get();

      return response()->json([
         '_debug' => DB::getQueryLog(),
         'items' => $items,
         'output' => $items->pluck('nama', 'id'),
      ]);
   }

   public function customer()
   {
      DB::enableQueryLog();

      $items = Mcustsupp::query()
         ->where('role', 'Customer')
         ->where(function($q) {
            if(request()->filled('keyword')) {
               $q->where('nama', 'LIKE', '%'. request('keyword') .'%');
            }
         })
         ->get();

      return response()->json([
         '_debug' => DB::getQueryLog(),
         'items' => $items,
         'output' => $items->pluck('nama', 'id'),
      ]);
   }

   public function barang()
   {
      DB::enableQueryLog();

      $items = Mbarang::query()
         ->where(function($q) {
            if(request()->filled('keyword')) {
               $q->where('nama', 'LIKE', '%'. request('keyword') .'%');
            }
         })
         ->get();

      return response()->json([
         '_debug' => DB::getQueryLog(),
         'items' => $items,
         'output' => $items->pluck('nama', 'id'),
      ]);
   }
}
