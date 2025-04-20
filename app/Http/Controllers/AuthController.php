<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
   public function index()
   {
      return view('auth.login');
   }

   public function store(Request $request)
   {
      try {
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
         ]);

         if(!auth()->attempt($credentials)) {
            throw new \Exception('Login gagal');
         }

         $request->session()->regenerate();
         return redirect()->intended('dashboard');
      } catch (ValidationException $e) {
         foreach ($e->errors() as $error) {
            toastr()->error(implode(',', $error));
         }

         return back()->withErrors($e->validator)->withInput();
      } catch (\Exception $e) {
         toastr()->error($e->getMessage());

         return back()->withErrors([
            'email' => $e->getMessage(),
         ])->onlyInput('email');
      }
   }
}
