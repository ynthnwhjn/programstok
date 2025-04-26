@extends('layouts.app')

@section('pageTitle', 'Product')

@section('boxHeaderButtons')
   <a href="{{route('products.create')}}" class="btn btn-primary">Create</a>
   <a href="{{route('products.index')}}" class="btn btn-default">Back</a>
@endSection

@section('content')
   <form action="{{ route($formAction, $formfield) }}" method="POST" autocomplete="off">
      @csrf
      @method($formMethod)

      <div class="box-body">
         <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" value="{{$formfield->nama}}">
         </div>

         <div class="form-group">
            <label>Harga Jual</label>
            <input type="text" class="form-control" value="{{$formfield->harga_jual}}">
         </div>
      </div>
      <div class="box-footer">
         <a href="{{route('products.index')}}" class="btn btn-default">Back</a>
      </div>
   </form>
@endsection
