@extends('layouts.app')

@section('pageTitle', 'Sales Invoice')

@section('boxHeaderButtons')
   <a href="{{route('sales_invoices.create')}}" class="btn btn-primary">Create</a>
@endSection

@section('content')
<div class="box-body">
   <table id="table1" class="table table-hover">
   </table>

   <!-- <table class="table">
      <thead>
         <tr>
            <th style="width: 40px;">#</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Customer</th>
            <th style="width: 100px;"></th>
         </tr>
      </thead>
      <tbody>
         @foreach($items as $index => $row)
            <tr>
               <td>{{$index + 1}}</td>
               <td>{{$row->kode}}</td>
               <td>{{$row->tanggal}}</td>
               <td>{{$row->customer->nama}}</td>
               <td class="text-center">
                  <a class="btn btn-default" href="{{route('sales_invoices.show', $row)}}">View</a>
               </td>
            </tr>
         @endforeach
      </tbody>
   </table> -->
</div>

@javascript('items', $items)

@push('scripts')
<script>
   (function() {
      $('#table1').dataTable({
         language: {
            lengthMenu: "_MENU_",
            info: "_START_-_END_ / _TOTAL_",
            sInfo: "_START_-_END_ / _TOTAL_",
            infoFiltered: "(_MAX_)",
            search: "",
         },
         data: items,
         columns: [
            {
               title: '#',
               width: 60,
               render: function(data, type, row, meta) {
                  return meta.row + 1;
               },
            },
            { data: 'kode', title: 'Kode' },
            { data: 'tanggal', title: 'Tanggal', type: 'html', width: 120 },
            { data: 'customer.nama', title: 'Customer' },
            {
               orderable: false,
               width: 100,
               title: '<i class="fa fa-bars"></i>',
               className: 'dt-center',
               render: function(data, type, row, meta) {
                  return '<a class="btn btn-default btn-sm" href="'+ route('sales_invoices.show', row) +'"><i class="fa fa-pencil"></i></a>';
               },
            },
         ],
      });
   })();
</script>
@endpush

@endsection
