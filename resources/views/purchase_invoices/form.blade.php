@extends('layouts.app')
@section('content')
<div class="box box-default">
   <div class="box-header with-border">
      <h3 class="box-title">{{$pageTitle}}</h3>
   </div>
   <form action="{{ route($formAction, $formfield) }}" method="POST" autocomplete="off">
      @csrf
      @method($formMethod)
      <div>{{$formfield}}</div>

      <div class="box-body">
         <div class="form-group">
            <label>Kode</label>
            <input type="text" class="form-control" name="kode" value="{{$formfield->kode}}">
         </div>

         <div class="form-group">
            <label>Supplier</label>
            <input type="text" class="form-control" name="supplier_nama" value="{{ $formfield->supplier ? $formfield->supplier->nama : '' }}">
            <input type="text" name="supplier_id" value="{{$formfield->supplier_id}}">
         </div>
      </div>
      <div class="box-footer">
         <button type="submit" class="btn btn-primary">Save</button>
         <a href="{{$actionIndex}}" class="btn btn-default">Back</a>
      </div>
   </form>
</div>
@endsection
