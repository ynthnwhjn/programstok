@extends('layouts.app')

@section('pageTitle', 'Laporan Stok Barang')
@section('ngController', 'LaporanStokBarangController')

@section('boxHeaderButtons')
<button type="button" ng-if="gridlaporan1.data.length" ng-click="actionPracetak()" class="btn btn-default">Print <i class="fa fa-print"></i></button>
<button type="button" ng-click="openModal1($event)" class="btn btn-default"><i class="fa fa-search"></i></button>
@endSection

@section('content')
<div class="box-body">
   <div ui-grid="gridlaporan1" ui-grid-resize-columns ui-grid-auto-resize></div>
</div>

@push('scripts')
<script src="{{asset('js/laporan_stok_barang/laporan_stok_barang.js')}}"></script>
<script type="text/ng-template" id="modal1.html">
   <div class="modal-header">
      <h4 class="modal-title">Filter</h4>
   </div>
   <div class="modal-body">
      <div class="form-group">
         <label>Tanggal</label>
         <input datepickr type="text" class="form-control" ng-model="filter.tanggal_akhir">
      </div>
   </div>
   <div class="modal-footer">
      <button class="btn btn-primary" type="button" ng-click="actionSearch($event)">Search</button>
      <button class="btn btn-default" type="button" ng-click="$dismiss()">Cancel</button>
   </div>
</script>
@endpush

@endsection
