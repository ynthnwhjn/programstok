<!DOCTYPE html>
<html lang="en" ng-app="app">
@include('shared.head')
<body class="hold-transition skin-black sidebar-mini fixed">
   <div class="wrapper">
      @include('shared.main-header')
      @include('shared.main-sidebar')
      <div class="content-wrapper">
         @hasSection('ngController')
            <div class="content" ng-controller="@yield('ngController')">
         @else
            <div class="content">
         @endif()
            <div class="box box-default">
               @hasSection('pageTitle')
                  <div class="box-header with-border">
                     <h3 class="box-title">@yield('pageTitle')</h3>

                     @hasSection('boxHeaderButtons')
                        <div>
                           @yield('boxHeaderButtons')
                        </div>
                     @endif
                  </div>
               @endif
               @yield('content')
            </div>
         </div>
      </div>
   </div>

   @include('shared.script-footer')
</body>
</html>
