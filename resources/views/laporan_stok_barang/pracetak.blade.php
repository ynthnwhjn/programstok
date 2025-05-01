@extends('layouts.pracetak')
@section('content')
   <h1 class="text-center">Laporan Stok Barang</h1>
   <div class="text-center">Tanggal: {{$tanggal}}</div>
   <br>

   <table class="table table-bordered">
      <thead>
         <tr>
            <th class="text-center">Barang</th>
            <th class="text-center">Stok Awal</th>
            <th class="text-center">Stok Masuk</th>
            <th class="text-center">Stok Keluar</th>
            <th class="text-center">Stok Akhir</th>
         </tr>
      </thead>
      <tbody>
         @foreach($items as $row)
         <tr>
            <td>{{$row->barang_nama}}</td>
            <td style="width: 80px;" class="text-right">{{floatval($row->stok_awal)}}</td>
            <td style="width: 80px;" class="text-right">{{floatval($row->stok_masuk)}}</td>
            <td style="width: 80px;" class="text-right">{{floatval($row->stok_keluar)}}</td>
            <td style="width: 80px;" class="text-right">{{floatval($row->stok_akhir)}}</td>
         </tr>
         @endforeach
         <tr>
            <td class="text-right">Total</td>
            <td class="text-right">{{$total_stok_awal}}</td>
            <td class="text-right">{{$total_stok_masuk}}</td>
            <td class="text-right">{{$total_stok_keluar}}</td>
            <td class="text-right">{{$total_stok_akhir}}</td>
         </tr>
      </tbody>
   </table>
@endSection
