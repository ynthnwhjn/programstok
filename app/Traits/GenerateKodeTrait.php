<?php

namespace App\Traits;

use App\Models\Variabel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait GenerateKodeTrait
{
   public function generateKodeTransaksi($table, $prefix, $format, $tanggal = null)
   {
      if(!$tanggal) {
         $tanggal = Carbon::now()->toDateString();
      }

      $tahun = Carbon::parse($tanggal)->format('y');
      $bulan = Carbon::parse($tanggal)->format('m');

      $variabel = Variabel::query()
         ->where('nama', 'LIKE', 'field%')
         ->get()
         ->pluck('nilai', 'nama');

      $kode = $prefix . str_replace(['YY', 'MM'], [$tahun, $bulan], $format);

      if(preg_match('/N+/', $format, $matches)) {
         $kode = str_replace($matches[0], '', $kode);

         $last_record = DB::table($table)
            ->where($variabel['field_kode'], 'LIKE', $kode . '%')
            ->orderByDesc($variabel['field_kode'])
            ->first();

         $last_number = 1;
         if($last_record) {
            $last_number = str_replace($kode, '', $last_record->{$variabel['field_kode']});
            $last_number = floatval($last_number)+1;
         }

         $kode .= str_pad($last_number, strlen($matches[0]), '0', STR_PAD_LEFT);
      }

      return $kode;
   }
}
