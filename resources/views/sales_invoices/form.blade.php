@extends('layouts.app')
@section('content')
<div class="box box-default">
   <div class="box-header with-border">
      <h3 class="box-title">{{$pageTitle}}</h3>
   </div>
   <form method="POST" autocomplete="off">
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
         <a href="{{$actionIndex}}" class="btn btn-default">Back</a>
      </div>
   </form>
</div>
@endsection
