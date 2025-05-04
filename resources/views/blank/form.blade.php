@extends('layouts.app')

@section('pageTitle', 'Title')

@section('content')
   <form name="frm" action="{{ route($formAction, $formfield) }}" method="POST" autocomplete="off" ng-submit="save(frm, $event)">
      @csrf
      @method($formMethod)

      <div class="box-body"></div>

      <div class="box-footer">
         @if($routeMethod !== 'show')
            <button type="submit" class="btn btn-primary">Save</button>
         @endif
         <a href="{{route('purchase_invoices.index')}}" class="btn btn-default">Back</a>
      </div>
   </form>
@endsection
