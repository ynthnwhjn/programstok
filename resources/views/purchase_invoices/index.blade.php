@extends('layouts.app')

@section('pageTitle', 'Purchase Invoice')

@section('boxHeaderButtons')
   <a href="{{route('purchase_invoices.create')}}" class="btn btn-primary">Create</a>
@endSection

@section('content')
   <div class="box-body">
      <table class="table">
         <thead>
            <tr>
               <th style="width: 40px;">#</th>
               <th>Kode</th>
               <th>Tanggal</th>
               <th>Supplier</th>
               <th style="width: 100px;"></th>
            </tr>
         </thead>
         <tbody>
            @foreach($items as $index => $row)
               <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$row->kode}}</td>
                  <td>{{$row->tanggal}}</td>
                  <td>{{$row->supplier->nama}}</td>
                  <td class="text-center">
                     <a class="btn btn-default" href="{{route('purchase_invoices.show', $row)}}">View</a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
@endsection
