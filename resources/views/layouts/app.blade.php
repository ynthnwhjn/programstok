<!DOCTYPE html>
<html lang="en">
@include('shared.head')
<body class="hold-transition skin-black sidebar-mini fixed">
   <div class="wrapper">
      @include('shared.main-header')
      @include('shared.main-sidebar')
      <div class="content-wrapper">
         <div class="content">
            <div class="box box-default">
               <div class="box-header with-border">
                  <h3 class="box-title">@yield('pageTitle')</h3>

                  @hasSection('boxHeaderButtons')
                     <div>
                        @yield('boxHeaderButtons')
                     </div>
                  @endif
               </div>
               @yield('content')
            </div>
         </div>
      </div>
   </div>

   @include('shared.script-footer')
</body>
</html>
