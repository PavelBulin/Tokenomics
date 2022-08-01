<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
  public function googleRedirect ()
    {
      return Socialite::driver('google')->redirect();
    }


  public function loginWithGoogle()
  {
    try {
      $user = Socialite::driver('google')->user();
      $isUser = User::where('google_id', $user->id)->first();

      # Если такой пользователь есть авториз
      # Иначе регестр

      if ($isUser) {
        Auth::login($isUser);

        return redirect('admin');

      } else {
        $createUser = User::create([
          'name' => $user->name,
          'email' => $user->email,
          'google_id' => $user->id,
          'password' => encrypt('user'),
        ]);

        Auth::login($createUser);

        return redirect('admin');
      }
    } catch (Exception $exception) {
      // dd($exception->getMessage("Не удалось авторизоваться"));
      dd("Не удалось авторизоваться");
    }
  }
}