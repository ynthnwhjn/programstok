@extends('layouts.app')

@section('pageTitle', 'Purchase Invoice')

@section('boxHeaderButtons')
   <a href="{{route('purchase_invoices.create')}}" class="btn btn-primary">Create</a>
   <a href="{{route('purchase_invoices.index')}}" class="btn btn-default">Back</a>
@endSection

@section('content')
   <form action="{{ route($formAction, $formfield) }}" method="POST" autocomplete="off">
      @csrf
      @method($formMethod)

      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Kode</label>
                  <input type="text" readonly placeholder="AUTO" class="form-control" name="kode" value="{{$formfield->kode}}">
               </div>

               <div class="form-group">
                  <label>Tanggal</label>
                  <x-datepicker name="tanggal" value="{{ old('tanggal', $formfield->tanggal) }}" />
               </div>

               <div class="form-group">
                  <label>Supplier</label>
                  <x-select2 name="supplier_id" url="{{ route('api.supplier') }}" :selected="old('supplier_id', $formfield->supplier_id)" />
               </div>

               <!-- <div class="form-group">
                  <label>Barang</label>
                  <x-select2 name="barang_id" url="{{ route('api.barang') }}" :selected="old('barang_id')" />
               </div> -->
            </div>
         </div>
      </div>
      <div class="box-footer">
         <button type="submit" class="btn btn-primary">Save</button>
         <a href="{{route('purchase_invoices.index')}}" class="btn btn-default">Back</a>
      </div>
   </form>
@endsection
