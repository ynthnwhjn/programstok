/******/ (() => { // webpackBootstrap
/*!************************************************!*\
  !*** ./resources/views/laporan/stok_barang.js ***!
  \************************************************/
(function () {
  'use strict';

  angular.module('app').controller('LaporanStokBarangController', LaporanStokBarangController);
  function LaporanStokBarangController($scope, $uibModal, $httpParamSerializer) {
    $scope.filter = {};
    console.log($scope.filter);
    $scope.openModal1 = function (evt) {
      var modalInstance1 = $uibModal.open({
        templateUrl: 'modal1.html',
        backdrop: 'static',
        scope: $scope,
        controller: function controller($scope, $http, $uibModalInstance) {
          $scope.actionSearch = function (evt) {
            var url = route('laporan_stok_barang.datasource', $scope.filter);
            $http.get(url).then(function (response) {
              var result = response.data;
              $uibModalInstance.close(result);
            });
          };
        }
      });
      modalInstance1.result.then(function (result) {
        $scope.gridlaporan1.data = result.items;
      }, function () {
        //
      });
    };
    $scope.gridlaporan1 = {
      enableColumnMenus: false,
      data: [],
      columnDefs: [{
        name: 'barang_nama',
        field: 'barang_nama',
        displayName: 'Barang',
        width: 350
      }, {
        name: 'stok_awal',
        field: 'stok_awal',
        width: 110,
        cellFilter: 'number',
        cellClass: 'text-right'
      }, {
        name: 'stok_masuk',
        field: 'stok_masuk',
        width: 110,
        cellFilter: 'number',
        cellClass: 'text-right'
      }, {
        name: 'stok_keluar',
        field: 'stok_keluar',
        width: 110,
        cellFilter: 'number',
        cellClass: 'text-right'
      }, {
        name: 'stok_akhir',
        field: 'stok_akhir',
        width: 110,
        cellFilter: 'number',
        cellClass: 'text-right'
      }]
    };
  }
})();
/******/ })()
;