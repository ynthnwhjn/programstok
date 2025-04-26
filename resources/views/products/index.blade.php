@extends('layouts.app')

@section('pageTitle', 'Product')

@section('boxHeaderButtons')
   <a href="{{route('products.create')}}" class="btn btn-primary">Create</a>
@endSection

@section('content')
   <div class="box-body">
      <table class="table">
         <thead>
            <tr>
               <th>#</th>
               <th>Nama</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach($items as $index => $row)
               <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$row->nama}}</td>
                  <td>
                     <a class="btn btn-default" href="{{route('products.show', $row)}}">View</a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
@endsection
