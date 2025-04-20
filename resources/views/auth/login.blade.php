<!DOCTYPE html>
<html lang="en">
   @section('title', 'Login')
   @include('shared.head')
<body class="hold-transition login-page">
   <div class="login-box">
      <div class="login-box-body">
         <form action="{{route('login.store')}}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group">
               <label>Email</label>
               <input type="text" name="email" class="form-control" value="{{old('email')}}">
            </div>

            <div class="form-group">
               <label>Password</label>
               <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
         </form>
      </div>
   </div>
@include('shared.script-footer')
</body>
</html>
