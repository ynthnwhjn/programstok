<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use stdClass;

abstract class CrudController extends Controller
{
   protected $viewPath;
   protected $pageTitle;
   protected $actionIndex;
   protected $actionCreate;
   protected $formAction;
   protected $formMethod;

   public function __construct()
   {
      $this->viewPath = request()->segment(1);

      if(request()->routeIs(request()->segment(1) . '.*')) {
         $this->actionIndex = route(request()->segment(1) . '.index');
         $this->actionCreate = route(request()->segment(1) . '.create');
      }

      if(request()->routeIs(request()->segment(1) . '.create')) {
         $this->formAction = request()->segment(1) . '.store';
         $this->formMethod = 'POST';
      }
      else if(request()->routeIs(request()->segment(1) . '.update')) {
         $this->formAction = request()->segment(1) . '.update';
         $this->formMethod = 'PUT';
      }

      $this->pageTitle = Str::singular(Str::headline($this->viewPath));
      // $this->pageTitle = Str::headline(Str::singular($this->viewPath));
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $view_path = $this->viewPath . '.index';

      $data = [
         'pageTitle' => $this->pageTitle,
         'actionCreate' => $this->actionCreate,
         'items' => $this->setupList()
      ];

      // array_merge($data, $this->setupList());

      if(!view()->exists($view_path)) {
         $view_path = 'blank.index';
      }

      return view($view_path, $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $view_path = $this->viewPath . '.form';

      $data = [
         'pageTitle' => $this->pageTitle,
         'actionIndex' => $this->actionIndex,
         'formAction' => $this->formAction,
         'formMethod' => $this->formMethod,
         'formfield' => $this->setupForm(),
      ];

      if(!view()->exists($view_path)) {
         $view_path = 'blank.form';
      }

      return view($view_path, $data);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $view_path = $this->viewPath . '.form';

      $data = [
         'pageTitle' => $this->pageTitle,
         'actionIndex' => $this->actionIndex,
         'formAction' => $this->formAction,
         'formMethod' => $this->formMethod,
         'formfield' => $this->setupForm(),
      ];

      if(!view()->exists($view_path)) {
         $view_path = 'blank.form';
      }

      return view($view_path, $data);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      //
   }

   public abstract function setupList();
   public abstract function setupForm();
}
