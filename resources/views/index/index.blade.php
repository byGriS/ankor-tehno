@extends('layouts.layout')

@section('content')
{{-- <header-slider></header-slider> --}}
<div class="container-my">
  <div class="slideshow">
    <div id="slideshow0" class="nivoSlider">
      <img src="/images/header/slide4.jpg" alt="Продажа промышленного оборудованя" />
      <img src="/images/header/slide3.jpg" alt="Продажа промышленного оборудованя" />
      <img src="/images/header/slide1.png" alt="Продажа промышленного оборудованя" />
      <img src="/images/header/slide2.jpg" alt="Продажа промышленного оборудованя" />
    </div>    
  </div>
  <div id="slide3Data" class="slider-text" style="display: none">
    <div class="slider-title">СКИДКИ С ПЕРВОГО ЗАКАЗА<br/>ПРИ ЗАКЛЮЧЕНИИ ДОГОВОРА</div>
    <div><a href="{{route('catalog', [], false)}}" class="btn-in-slider">В КАТАЛОГ</a></div>
  </div>
</div>
<brand-slider></brand-slider>
{{-- @include('static.logofirms') --}}
<div class="main-content">
  <div class="bg-grey">
    <div class="container-my py-5">
      <div class="row">
        <div class="col-12 col-sm-4 d-sm-block col-md-3 ">
          <sidebar-categories :categories="{{$categoriesSidebar}}"></sidebar-categories>
        </div>
        <div class="col-12 col-sm-8">
          <p class="index_h2">ЛЕТНИЕ ПРЕДЛОЖЕНИЯ</p>
          <div class="row align-self-stretch">
            @foreach ($productsStock as $item)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-5 pr-5px">
              <product :product="{{$item}}"></product>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="main-about container-my">
    <h1>Продажа строительного и промышленного оборудования</h1>
    <div>
      <p><strong>ООО «АНКОР-ТЕХНО»</strong> – является дилером ведущих производителей строительного и промышленного оборудования на территории РФ.<em> В наличии большой ассортимент: <a href="https://ankor-tehno.ru/catalog/kompressory/porsnevye-kompressory" target="_blank" rel="noreferrer noopener">поршневых компрессоров</a>, <a href="https://ankor-tehno.ru/catalog/generatory-elektrostancii/dizelnye" target="_blank" rel="noreferrer noopener">дизельных генераторов</a>&nbsp;и <a href="https://ankor-tehno.ru/catalog/svarochnoe-oborudovanie-i-pusko-zaryadnye-ustrojstva" target="_blank" rel="noreferrer noopener">сварочного оборудования</a>.</em>&nbsp;&nbsp;Наша компания получает полную поддержку со стороны производителей в части обеспечения запчастями и расходными материалами.</p>
      <p>Специалисты по продажам, которые максимально внимательно выслушают Вас и помогут в выборе оборудования. Хорошо налаженная сервисная служба: в сервисном отделе компании работают подготовленные и обеспеченные всем необходимым специалисты.</p>
      <p>Преимущества:</p>
      <ul>
        <li><span>оперативность поставок;</span></li>
        <li><span>быстрое реагирование на потребности заказчиков.</span></li>
      </ul>
      <h3>ООО «АНКОР-ТЕХНО» предлагает полный спектр услуг:</h3>
      <ul>
        <li><span>проектирование;</span></li>
        <li><span>подбор оборудования;</span></li>
        <li><span>поставка оборудования;</span></li>
        <li><span>монтаж;</span></li>
        <li><span>запуск в работу;</span></li>
      </ul>
    </div>
  </div>
</div>

@include('components.oneclick')
@endsection

@section('title')
Магазин строительного и промышленного оборудования в Самаре - Анкор-Техно
@endsection

@section('description')
Продажа строительного и промышленного оборудования оптом с доставкой по Самаре и РФ. В том числе, дизельные генераторы, поршневые компрессоры, сварочное оборудование. Цены на 15-20% ниже рыночных! Звоните! 8 (846) 277-17-78, 8 (917) 162-51-16.
@endsection