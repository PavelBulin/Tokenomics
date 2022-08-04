<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {

      if (Auth::check()) {
          return redirect(route('user.admin'));
        }

      $formFields = $request->only(['email', 'password']);

      if(Auth::attempt($formFields)) {
          return redirect()->intended(route('user.admin'));
      }

      return redirect(route('user.login'))->withErrors([
          'email' => 'Не удалось авторизоваться'
      ]);
    }
}
