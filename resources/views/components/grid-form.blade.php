<div>
   @if($routeMethod == 'show')
      <div ui-grid="{{$gridOptions}}" ui-grid-resize-columns ui-grid-auto-resize></div>
   @else
      <div ui-grid="{{$gridOptions}}" ui-grid-resize-columns ui-grid-auto-resize ui-grid-edit></div>
   @endif
</div>
