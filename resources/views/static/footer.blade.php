<footer>
  <div class="container-my footer-data">
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="footer-title">{{mb_strtoupper($shopInfo['header_title']->value)}}</div>
        <div>
          <div class="footer-icon footer-address-icon d-none d-md-block"></div>{{$shopInfo['address']->value}}
        </div>
        <div>
          <div class="footer-icon footer-phone-icon d-none d-md-block"></div><strong>{{$shopInfo['phone1']->value}}</strong>
        </div>
        <div><strong>{{$shopInfo['phone2']->value}}</strong></div>
        <div>
          <div class="footer-icon footer-email-icon d-none d-md-block"></div>{{$shopInfo['email']->value}}
        </div>
      </div>
      <div class="col-12 col-lg-9">
        <footer-categories-list :categories-main="{{$categoriesMain}}"></footer-categories-list>
      </div>
    </div>
  </div>
  <div class="footer-menu d-none d-md-block">
    <div class="container-my d-flex justify-content-between align-items-center">
      <a href="/" class="header-logo footer-logo d-none d-lg-block col-lg-3 "></a>
      <a href="/" class="header-logo-mini footer-logo col-1 d-lg-none"></a>
      <a class="footer-menu-item" href="{{route('about')}}">О КОМПАНИИ</a>
      <a class="footer-menu-item" href="{{route('catalog')}}">КАТАЛОГ ТОВАРОВ</a>
      <a class="footer-menu-item" href="{{route('services')}}">НАШИ УСЛУГИ</a>
      {{-- <a class="footer-menu-item" href="{{route('articles')}}">СТАТЬИ</a> --}}
      <a class="footer-menu-item" href="{{route('contacts')}}">КОНТАКТЫ</a>
      <div class="d-none d-sm-block col-md-4 col-lg-3 col-xl-3 text-right header-address">
        <span class="icon address_icon">г. Самара, пр. Кирова, д. 255</span>
        <br>
        <span class="icon email_icon">ankor-tehno@mail.ru</span>
      </div>
    </div>
  </div>
  <div class="copyright">
    Copyright 2009-2014 «АНКОР-ТЕХНО»
  </div>
</footer>