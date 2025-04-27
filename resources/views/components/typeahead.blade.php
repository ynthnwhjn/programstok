<div wrapper-typeahead="{{$paramDirective}}">
   <input type="text" class="form-control"
      name="{{$name}}"
      placeholder="Search"
      ng-model="{{$ngModel}}"
      uib-typeahead="item as item.{{$itemLabel}} for item in fetchItems($viewValue)"
      typeahead-on-select="onSelect($item, $model, $label, $event)">
</div>
