@extends('layouts.layout')

@section('content')
@include('components.breadcrumb')
<div class="main-content">
  <div class="bg-grey">
    <div class="container-my py-5">
      <div class="row">
        <div class="col-12">
          <h1>КОНТАКТЫ</h1>
          <div class="contacts-ya-map">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Acbbd4384d753f3d1ee141957a8ece9efdffe23365bec0fccab6a2f4037850d71&amp;source=constructor" frameborder="0"></iframe>
          </div>
          <div class="mt-5 row text-center">
            <div class="col-12 col-md-6 col-lg-4"><span class="icon address_icon">{{$shopInfo['address']->value}}</span></div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="d-flex contacts-header-phones justify-content-center"><div class="contacts-phone_icon"></div> <div>
                {{$shopInfo['phone1']->value}}<br/>{{$shopInfo['phone2']->value}}
              </div></div>
            </div>
            <div class="col-12 col-md-6 col-lg-4"><span class="icon email_icon">{{$shopInfo['email']->value}}</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection