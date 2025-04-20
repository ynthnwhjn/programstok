<!DOCTYPE html>
<html lang="en">
@include('shared.head')
<body class="hold-transition skin-black sidebar-mini fixed">
   <div class="wrapper">
      @include('shared.main-header')
      @include('shared.main-sidebar')
      <div class="content-wrapper">
         <div class="content">
            @yield('content')
         </div>
      </div>
   </div>

   @include('shared.script-footer')
</body>
</html>
