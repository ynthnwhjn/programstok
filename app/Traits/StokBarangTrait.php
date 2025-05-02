<?php

namespace App\Traits;

use App\Models\Tstokbarang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait StokBarangTrait
{
   public function checkStock($data)
   {
      $barang_ids = collect($data)
         ->pluck('barang_id')
         ->filter(function($value) {
            return !is_null($value);
         })
         ->toArray();

      foreach ($data as $row) {
         $stokbarang = DB::table('tstokbarang', 'a')
            ->whereNull('a.deleted_at')
            ->where('a.barang_id', $row['barang_id'])
            ->join('mbarang', 'mbarang.id', '=', 'a.barang_id')
            ->selectRaw('
               a.barang_id,
               a.gudang_id,
               SUM(a.jumlah) AS stok,
               mbarang.nama AS barang_nama
            ')
            ->groupByRaw('
               a.barang_id,
               a.gudang_id
            ')
            ->first();

         if(!isset($stokbarang->barang_id)) {
            throw new \Exception('Stok tidak mencukupi ('. $row['barang_id'] .')');
         }

         $sisa_stok = floatval($stokbarang->stok) + floatval($row['jumlah']);
         if($sisa_stok < 0) {
            throw new \Exception($stokbarang->barang_nama .', stok tidak mencukupi ('. floatval($stokbarang->stok) .')');
         }
      }
   }

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
   }
}
