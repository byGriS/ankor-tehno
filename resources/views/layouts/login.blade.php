@extends('layouts.layout')

@section('content')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
<div class="text-center">
  @auth
    <a href="{{route('admin.orders')}}">Панель администратора</a>    
  @endauth
  <form class="form-signin" action="{{route('login')}}" method="POST">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">{{config('app.name')}}</h1>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email"  required autofocus>
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль" required>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
  </form>

</div>
@endsection