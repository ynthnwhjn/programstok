<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanStokBarangController extends Controller
{
   public function index()
   {
      return view('laporan_stok_barang.index');
   }

   private function _datasource()
   {
      $tanggal_akhir = request('tanggal_akhir', Carbon::now()->toDateString());

      $items = DB::table('tstokbarang', 'a')
         ->whereNull('a.deleted_at')
         ->join('mbarang', 'mbarang.id', '=', 'a.barang_id')
         ->selectRaw("
            a.barang_id,
            SUM(
               IF(
                  DATE(a.tanggal) < '". $tanggal_akhir ."',
                  a.jumlah,
                  0
               )
            ) AS stok_awal,
            SUM(
               IF(
                  DATE(a.tanggal) >= '". $tanggal_akhir ."'
                  AND a.jumlah > 0,
                  a.jumlah,
                  0
               )
            ) AS stok_masuk,
            SUM(
               IF(
                  DATE(a.tanggal) >= '". $tanggal_akhir ."'
                  AND a.jumlah < 0,
                  ABS(a.jumlah),
                  0
               )
            ) AS stok_keluar,
            SUM(a.jumlah) AS stok_akhir,
            mbarang.nama AS barang_nama
         ")
         ->groupByRaw('a.barang_id')
         ->get();

      return $items;
   }

   public function datasource()
   {
      return response()->json([
         'items' => $this->_datasource(),
      ]);
   }

   public function pracetak()
   {
      $mpdf = new \Mpdf\Mpdf();

      $items = $this->_datasource();

      $data['total_stok_awal'] = collect($items)->sum('stok_awal');
      $data['total_stok_masuk'] = collect($items)->sum('stok_masuk');
      $data['total_stok_keluar'] = collect($items)->sum('stok_keluar');
      $data['total_stok_akhir'] = collect($items)->sum('stok_akhir');
      $data['tanggal'] = request('tanggal_akhir');
      $data['items'] = $items;

      $html_output = view('laporan_stok_barang.pracetak', $data);

      $mpdf->writeHTML($html_output);
      $mpdf->output();

      // return view('laporan_stok_barang.pracetak', $data);

      // return response()->json([
      //    'items' => $this->_datasource(),
      // ]);
   }
}
