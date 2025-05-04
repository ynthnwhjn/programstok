@extends('layouts.app')

@section('pageTitle', 'Customer')

@section('boxHeaderButtons')
   <a href="{{route('customers.create')}}" class="btn btn-primary">Create</a>
@endSection

@section('content')
   <div class="box-body">
      <table class="table">
         <thead>
            <tr>
               <th style="width: 40px;">#</th>
               <th>Nama</th>
               <th style="width: 100px;"></th>
            </tr>
         </thead>
         <tbody>
            @foreach($items as $index => $row)
               <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$row->nama}}</td>
                  <td class="text-center">
                     <a class="btn btn-default" href="{{route('customers.show', $row)}}">View</a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
@endsection
