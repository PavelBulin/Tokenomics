<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SocialController;

// Route::get('/', function () {
//   return view('home');
// });

Route::get('/', [AdminController::class, 'index'])->name('home');

Route::get('/admin/msg', function () {
  return view('msg');
});



  Route::get('/admin/category', [AdminController::class, 'showCategory']);
  Route::get('/admin/form', [AdminController::class, 'сategoryForm'])->name('form');
  Route::get('/admin/tokenomic', [AdminController::class, 'tokenomic']);
  Route::get('/admin/show', [AdminController::class, 'showTokenomic'])->name('show');
  Route::post('/admin/create', [AdminController::class, 'createTokenomic'])->name('create');
  Route::post('/admin/change', [AdminController::class, 'changeTokenomic'])->name('change');
  Route::get('/admin/delete/{id?}', [AdminController::class, 'deleteTokenomic'])->name('delete');

  Route::view('/admin/msg', 'msg')->name('msg');

Route::name('user.')->group(function () {
  Route::view('/admin', 'admin')->middleware('auth')->name('admin');

  Route::get('/login', function () {
    if (Auth::check()) {
      return redirect(route('user.admin'));
    }

    return view('login');
  })->name('login');

  Route::post('/login', [LoginController::class, 'login']);

  Route::get('/logout', function () {
    Auth::logout();

    return redirect('/');
  })->name('logout');

  Route::get('/registration', function () {
    if (Auth::check()) {

      return redirect(route('user.admin'));
    }

    return view('registration');
  })->name('registration');

  Route::post('/registration', [RegisterController::class, 'save']);
});


Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('auth.google');
Route::get('auth/google/callback', [SocialController::class, 'loginWithGoogle']);