<div class="menu-top-wrapper">
  <div class="container-my">
    <div class="row align-items-center">
      <div class="d-none d-lg-block col-8 ">
        <a class="menu-top-item" href="{{route('about', [], false)}}">О КОМПАНИИ</a>
        <a class="menu-top-item" href="{{route('catalog', [], false)}}">КАТАЛОГ ТОВАРОВ</a>
        <a class="menu-top-item" href="{{route('services', [], false)}}">НАШИ УСЛУГИ</a>
        {{-- <a class="menu-top-item" href="{{route('articles', [], false)}}">СТАТЬИ</a> --}}
        <a class="menu-top-item" href="{{route('contacts', [], false)}}">КОНТАКТЫ</a>
      </div>
      <div class="col-4 d-lg-none">
        <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Меню
        </div>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('about', [], false)}}">О КОМПАНИИ</a>
          <a class="dropdown-item" href="{{route('catalog', [], false)}}">КАТАЛОГ ТОВАРОВ</a>
          <a class="dropdown-item" href="{{route('services', [], false)}}">НАШИ УСЛУГИ</a>
          {{-- <a class="dropdown-item" href="{{route('articles', [], false)}}">СТАТЬИ</a> --}}
          <a class="dropdown-item" href="{{route('contacts', [], false)}}">КОНТАКТЫ</a>
        </div>
      </div>
      <div class="col-5 col-lg-3">
        <form class="search-menu-top d-flex align-items-center" action="{{route('search')}}" method="GET">
          <input name="search" placeholder="Поиск..." />
          <div class="search-icon-menu-top"></div>
          <input class="hidden" type="submit" />
        </form>
      </div>
      <div class="col-3 col-lg-1 d-flex align-items-center">
        <basket-icon></basket-icon>
      </div>
    </div>
  </div>
</div>