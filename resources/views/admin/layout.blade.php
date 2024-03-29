<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{config('app.name')}}</title>
  <link rel="icon" href="favicon.svg">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body class="d-flex flex-column" >
  <header class="d-flex justify-content-between align-items-center fixed-top">
    <div class="d-flex align-items-center">
      <div class="navbar-dark mr-3 p-1">
        <button class="navbar-toggler d-sm-block d-md-none" onclick="window.toggleSidebar()">
          <span class="navbar-toggler-icon" ></span>
        </button>
      </div>
      <div>
        <h4><a href="/">{{config('app.name')}}</a></h4>
      </div>
    </div>
    <div class="d-flex">
      <div class="mr-3 p-1">{{Auth::user()->name}}</div>
      <a class="link-logout" href="/logout">Выход</a>
    </div>
  </header>
  <div class="h-100">
    <div class="sidebar h-100 ">
      <ul>
        {{-- <li class="{{ Request::route()->getName() == "admin.orders"? 'menu-selected' : ''}}"><a href="{{route('admin.orders')}}">Заказы</a></li> --}}
        <li class="{{ Request::route()->getName() == "admin.categories"? 'menu-selected' : ''}}"><a href="{{route('admin.categories')}}">Разделы</a></li>
        <li class="{{ Request::route()->getName() == "admin.products"? 'menu-selected' : ''}}"><a href="{{route('admin.products')}}">Товары</a></li>
      </ul>
    </div>
    <div id="app" class="content-wrap">
      @yield('content')
    </div>
  </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src={{asset('js/app.js')}}></script>

</html>