@extends('layouts.app')

@section('pageTitle', 'Customer')
@section('ngController', 'CustomerFormController')

@section('content')
   <form name="frm" action="{{ route($formAction, $formfield) }}" method="POST" autocomplete="off" ng-submit="save(frm, $event)">
      @csrf
      @method($formMethod)

      <div class="box-body">
         <div class="form-group">
            <label>Kode</label>
            <input type="text" class="form-control" name="nama" value="{{$formfield->nama}}" ng-model="formfield.nama">
         </div>
      </div>

      <div class="box-footer">
         @if($routeMethod !== 'show')
            <button type="submit" class="btn btn-primary">Save</button>
         @endif
         <a href="{{route('customers.index')}}" class="btn btn-default">Back</a>
      </div>
   </form>

   @javascript('formfield', $formfield)

   @push('scripts')
   <script src="{{asset('js/customers/customers_form.js')}}"></script>
   @endpush
@endsection
