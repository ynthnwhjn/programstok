@extends('layouts.app')
@section('content')
<div class="box box-default">
   <div class="box-header with-border">
      <h3 class="box-title">{{$pageTitle}}</h3>

      <div>
         <a href="{{$actionCreate}}" class="btn btn-primary">Create</a>
      </div>
   </div>
   <div class="box-body">
      <table class="table">
         <thead>
            <tr>
               <th>#</th>
               <th>Kode</th>
               <th>Tanggal</th>
               <th>Supplier</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach($items as $index => $row)
               <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$row->kode}}</td>
                  <td>{{$row->tanggal}}</td>
                  <td>{{$row->supplier->nama}}</td>
                  <td>
                     <a class="btn btn-default" href="{{route('purchase_invoices.show', $row)}}">View</a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
