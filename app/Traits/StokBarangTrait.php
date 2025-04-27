<?php

namespace App\Traits;

use App\Models\Tstokbarang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait StokBarangTrait
{
   public function saveStok($data, $transaksih_id, $jenis_transaksi)
   {
      $ignore_ids = collect($data)->pluck('transaksid_id')
         ->filter(function($value) {
            return $value != null;
         })
         ->toArray();

      Tstokbarang::query()
         ->where('transaksih_id', $transaksih_id)
         ->whereNotIn('transaksid_id', $ignore_ids)
         ->where('jenis_transaksi', $jenis_transaksi)
         ->delete();

      $data_stok = [];
      foreach ($data as $row) {
         $stokbarang = Tstokbarang::query()
            ->where('jenis_transaksi', $jenis_transaksi)
            ->where('transaksih_id', $row['transaksih_id'])
            ->where('transaksid_id', $row['transaksid_id'])
            ->first();

         if($stokbarang) {
            $stokbarang->update($row);
         }
         else {
            $row['created_at'] = Carbon::now();
            $data_stok[] = $row;
         }
      }

      if(count($data_stok) > 0) {
         Tstokbarang::insert($data_stok);
      }

      // DB::table('tstokbarang')->insert($data);
   }
}
