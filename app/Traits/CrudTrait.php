<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait CrudTrait
{
   public function listView($path, $data = [])
   {
      return view($path, $data);
   }

   public function formView($path, $data = [])
   {
      $formAction = request()->segment(1) . '.store';
      $formMethod = 'POST';
      $routeMethod = request()->route()->getActionMethod();

      if(!request()->routeIs(request()->segment(1) . '.create')) {
         $formAction = request()->segment(1) . '.update';
         $formMethod = 'PUT';
      }

      $mergeData['routeMethod'] = $routeMethod;
      $mergeData['formAction'] = $formAction;
      $mergeData['formMethod'] = $formMethod;

      return view($path, $data, $mergeData);
   }

   public function save()
   {
      //
   }
}
