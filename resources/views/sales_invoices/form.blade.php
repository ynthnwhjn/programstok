@extends('layouts.app')

@section('pageTitle', 'Sales Invoice')
@section('ngController', 'SalesInvoiceFormController')

@section('boxHeaderButtons')
   @if($routeMethod == 'show')
   <a href="{{route('sales_invoices.edit', $formfield)}}" class="btn btn-default">Edit</a>
   @endif
   <a href="{{route('sales_invoices.create')}}" class="btn btn-primary">Create</a>
   <a href="{{route('sales_invoices.index')}}" class="btn btn-default">Back</a>
@endSection

@section('content')
   <form name="frm" action="{{ route($formAction, $formfield) }}" method="POST" autocomplete="off" ng-submit="save(frm, $event)">
      @csrf
      @method($formMethod)

      <div class="box-body">
         <fieldset {{ $routeMethod == 'show' ? 'disabled' : '' }}>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Kode</label>
                     <input type="text" readonly placeholder="AUTO" class="form-control" name="kode" value="{{$formfield->kode}}" ng-model="formfield.kode">
                  </div>

                  <div class="form-group">
                     <label>Tanggal</label>
                     <x-datepicker name="tanggal" value="{{ old('tanggal', $formfield->tanggal) }}" ng-model="formfield.tanggal" />
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label>Customer</label>
                     <x-typeahead param-directive="browseCustomer()" item-label="nama" name="customer_nama" ng-model="formfield.customer.nama" />
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-4">
                  <x-typeahead param-directive="browseBarang()" item-label="nama" name="barang_nama" ng-model="formfield.barang.nama" />
               </div>
            </div>
            <div style="margin: 8px 0;">
               <x-grid-form gridOptions="gridform1" />
            </div>

            <div class="row">
               <div class="col-md-4 col-md-offset-8">
                  <div class="form-group">
                     <label>Subtotal</label>
                     <input type="text" readonly placeholder="AUTO" class="form-control" name="subtotal" value="{{old('subtotal', $formfield->subtotal)}}" ng-model="formfield.subtotal">
                  </div>
               </div>
            </div>
         </fieldset>
      </div>
      <div class="box-footer">
         @if($routeMethod !== 'show')
            <button type="submit" class="btn btn-primary">Save</button>
         @endif
         <a href="{{route('sales_invoices.index')}}" class="btn btn-default">Back</a>
      </div>
   </form>

   @javascript('formfield', $formfield)

   @push('scripts')
   <script src="{{asset('js/sales_invoices/sales_invoices_form.js')}}"></script>
   @endpush
@endsection

