<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {
  public function index() {
    return view('layouts.login');
  }

  public function login(AuthRequest $request, UserRepository $userRepository) {
    $user = $userRepository->getByEmail($request->email);
    if ($user == null)
      return Redirect::back()->withErrors(['Данная почта незарегистрирована'])->withInput();
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      return redirect()->intended(route('admin.orders'));
    } else {
      return Redirect::back()->withErrors(['Неверный пароль'])->withInput();
    }
  }

  public function logout() {
    Auth::logout();
    return redirect('/');
  }
}
