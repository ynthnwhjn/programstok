(function () {
   'use strict';

   angular.module('app').controller('SalesInvoiceFormController', SalesInvoiceFormController);

   function SalesInvoiceFormController($scope, $http, toastr) {
      $scope.formfield = Object.keys(formfield).length > 0 ? formfield : {};

      console.log($scope.formfield)

      $scope.browseCustomer = function () {
         return {
            url: route('api.customer'),
            onSelect: function ($item, $model, $label, $event) {
               console.log($item)
               $scope.formfield.customer = $item;
               $scope.formfield.customer_id = $item.id;
            }
         }
      }

      $scope.browseBarang = function () {
         return {
            url: route('api.barang'),
            onSelect: function ($item, $model, $label, $event) {
               console.log($item)

               var subtotal = 1 * parseFloat($item.harga_beli);

               $scope.gridform1.data.push({
                  barang: $item,
                  barang_id: $item.id,
                  jumlah: 1,
                  harga: $item.harga_beli,
                  subtotal: subtotal,
               });

               $scope.formfield.barang = {};
            }
         };
      }

      $scope.gridform1 = {
         data: [],
         columnDefs: [
            {
               name: 'barang_nama',
               field: 'barang.nama',
               displayName: 'Barang',
               enableCellEdit: false,
            },
            {
               name: 'jumlah',
               field: 'jumlah',
               cellClass: 'text-right',
               cellFilter: 'number',
               width: 90,
            },
            {
               name: 'harga',
               field: 'harga',
               cellClass: 'text-right',
               cellFilter: 'number',
               width: 120,
            },
            {
               name: 'subtotal',
               field: 'subtotal',
               cellClass: 'text-right',
               cellFilter: 'number',
               width: 120,
            },
         ],
      }

      if ($scope.formfield.sales_invoice_detail) {
         $scope.gridform1.data = $scope.formfield.sales_invoice_detail;
      }

      $scope.save = function (formCtrl, evt) {
         evt.preventDefault();

         console.log($scope.formfield)
         console.log($scope.gridform1.data)

         $scope.formfield.sales_invoice_detail = $scope.gridform1.data;

         var formElem = angular.element(evt.currentTarget);

         var req = {
            method: formElem.find('[name=_method]').val(),
            url: formElem.prop('action'),
            data: $scope.formfield,
            headers: {
               'X-CSRF-TOKEN': formElem.find('[name=_token]').val(),
            }
         };
         console.log(req)

         $http(req)
            .then(function (response) {
               var result = response.data;
               console.log(result)

               toastr.success('Success');

               if (result.redirect) {
                  window.location.replace(result.redirect);
               }
            }, function (reject) {
               console.log(reject)

               var err = reject.data;

               if (err.message) {
                  toastr.error(err.message);
               }
            });
      }
   }

})();
