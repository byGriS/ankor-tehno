<div class="container-my header">
  <div class="row h-100 align-items-center justify-content-between">
    <div class="d-none d-lg-block col-lg-3 h-100"><a href="/" class="header-logo h-100"></a></div>
    <div class="col-3 col-sm-2 d-lg-none col-md-3 h-100"><a href="/" class="header-logo-mini h-100"></a></div>
    <div class="col-4 d-block d-sm-none header-xs-title">АНКОР-ТЕХНО</div>
    <div class="d-none d-xl-block col-xl-2">
      <div class="header-title">{{mb_strtoupper($shopInfo['header_title']->value)}}</div>
    </div>
    <div class="col-5 col-sm-4 col-md-4 col-lg-3 d-flex header-phones justify-content-center">
      <div class="phone_icon"></div>
      <div>
        {{$shopInfo['phone1']->value}}<br/>{{$shopInfo['phone2']->value}}
      </div>
    </div>
    <div class="d-none d-sm-block col-sm-6 col-md-5 col-lg-5 col-xl-3 text-right header-address">
      <span class="icon address_icon">{{$shopInfo['address']->value}}</span><br/>
      <span class="icon email_icon">{{$shopInfo['email']->value}}</span>
    </div>
  </div>
</div>