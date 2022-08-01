<?php
// №1 #controller #regist #auth #login
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
  public function save(Request $request) {
    if (Auth::check()) {
      return redirect(route('user.admin'));
    }

    $validated = $request->validate([
       'name' => 'required',
       'email' => 'required|email',
       'password' => 'required',
    ]);


    if (User::where('email', $validated['email'])->exists()) {
      return redirect(route('user.registration'))->withErrors([
        'email' => 'Такой пользователь уже зарегистрирован'
      ]);

    }

    $user = User::create($validated);
    if ($user) {
      Auth::login($user);

      return redirect(route('user.admin'));
    }

    return redirect(route('user.login'))->withErrors([
      'formError' => 'Произошла ошибка при сохранении пользователя'
    ]);
  }
}
