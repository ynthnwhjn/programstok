@extends('layouts.app')

@section('pageTitle', 'Product')

@section('boxHeaderButtons')
<a href="{{route('products.create')}}" class="btn btn-primary">Create</a>
@endSection

@section('content')
<div class="box-body">
   <table id="table1" class="table table-hover">
   </table>
</div>

@javascript('items', $items)

@push('scripts')
<script>
   (function() {
      console.log(items)

      // https://datatables.net/reference/option/columns
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
            {
               data: 'nama',
               title: 'Nama',
            },
            {
               orderable: false,
               width: 100,
               title: '<i class="fa fa-bars"></i>',
               className: 'dt-center w100',
               render: function(data, type, row, meta) {
                  return '<a class="btn btn-default btn-sm" href="'+ route('products.show', row) +'"><i class="fa fa-pencil"></i></a>';
               },
            },
         ],
      });
   })();
</script>
@endpush
@endsection
