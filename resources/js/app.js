window.$ = window.jQuery = require('jquery');
window.moment = require('moment');
require('eonasdan-bootstrap-datetimepicker');
require('jquery-slimscroll');
require('bootstrap');
require('select2');
require('./adminlte');
require('angular');
require('angular-toastr');
require('angular-ui-bootstrap');
require('angular-ui-grid');
require('angular-validation/dist/angular-validation');
require('angular-validation/dist/angular-validation-rule');

(function () {
   'use strict';

   angular.module('app', [
      'toastr',
      'ui.grid',
      'ui.grid.edit',
      'ui.grid.rowEdit',
      'ui.grid.cellNav',
      'ui.grid.validate',
      'ui.grid.resizeColumns',
      'ui.grid.selection',
      'ui.grid.autoResize',
      'ui.grid.pinning',
      'ui.grid.pagination',
      'ui.grid.expandable',
      'ui.bootstrap',
      'validation',
      'validation.rule',
   ])
      .run(function ($rootScope) {
         //
      })

      .config(function ($provide) {
         $provide.decorator('GridOptions', function ($delegate, $timeout) {
            var gridOptions;
            gridOptions = angular.copy($delegate);

            gridOptions.initialize = function (options) {
               var initOptions;
               initOptions = $delegate.initialize(options);
               initOptions.onRegisterApi = function (gridApi) {
                  $timeout(function () {
                     gridApi.core.handleWindowResize();
                  }, 500);
               }

               return initOptions;
            }

            return gridOptions;
         });

      })

      .directive('datepickr', function ($timeout) {
         return {
            require: 'ngModel',
            link: function ($scope, elem, attrs, ngModelCtrl) {
               ngModelCtrl.$render = function () {
                  if(ngModelCtrl.$viewValue) {
                     ngModelCtrl.$setViewValue(ngModelCtrl.$viewValue);
                     // ngModelCtrl.$setViewValue(moment(ngModelCtrl.$viewValue));

                     // elem.data('DateTimePicker').date(ngModelCtrl.$viewValue);
                     elem.data('DateTimePicker').date(moment(ngModelCtrl.$viewValue));
                  }
               }

               var isDateEqual = function (d1, d2) {
                  return moment.isMoment(d1) && moment.isMoment(d2) && d1.valueOf() === d2.valueOf();
               };

               elem.on('dp.change', function (evt) {
                  $timeout(function () {
                     if (!isDateEqual(evt.date, ngModelCtrl.$viewValue)) {
                        ngModelCtrl.$setViewValue(moment(evt.date).format('YYYY-MM-DD HH:mm:ss'));
                        // ngModelCtrl.$setViewValue(evt.date);
                     }
                  });

               });

               elem.datetimepicker({
                  format: 'DD-MM-YYYY',
               });
            }
         }
      })

      .directive('wrapperTypeahead', function ($parse, $http) {
         return {
            scope: true,
            link: function ($scope, elem, attrs) {
               var typeaheadOptions = $parse(attrs.wrapperTypeahead)($scope);

               $scope.onSelect = function ($item, $model, $label, $event) {
                  typeaheadOptions.onSelect($item, $model, $label, $event);
               }

               $scope.fetchItems = function (viewValue) {
                  return $http.get(typeaheadOptions.url, {
                     params: {
                        keyword: viewValue
                     }
                  })
                     .then(function (response) {
                        var result = response.data;

                        return result.items;
                     });
               }
            }
         }
      })
})();
