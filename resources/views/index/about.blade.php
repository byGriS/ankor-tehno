@extends('layouts.layout')

@section('content')
@include('components.breadcrumb')
<div class="main-content">
  <div class="bg-grey">
    <div class="container-my py-5">
      <div class="row">
        <div class="col-12 col-sm-4 d-sm-block col-md-3">
          <sidebar-categories :categories="{{$categoriesSidebar}}"></sidebar-categories>
        </div>
        <div class="col-12 col-sm-8">
          <h1>О КОМПАНИИ</h1>
          <p><strong>ООО «АНКОР-ТЕХНО»</strong> – является дилером ведущих производителей строительного и промышленного оборудования на территории РФ. Наша компания получает полную поддержку со стороны производителей в части обеспечения запчастями и расходными материалами.</p>
          <p>Специалисты по продажам, которые максимально внимательно выслушают Вас и помогут в выборе оборудования. Хорошо налаженная сервисная служба: в сервисном отделе компании работают подготовленные и обеспеченные всем необходимым специалисты.</p>
          <p>Преимущества:</p>
          <ul>
            <li><span>оперативность поставок;</span></li>
            <li><span>быстрое реагирование на потребности заказчиков.</span></li>
          </ul>
          <h3>Структура компании</h3>
          <p>Специалисты по продажам, которые максимально внимательно выслушают Вас и помогут в выборе оборудования. Хорошо налаженная сервисная служба: в сервисном отделе компании работают подготовленные и обеспеченные всем необходимым специалисты.</p>
          <p>Преимущества:</p>
          <ul>
            <li><span>быстрое и качественное проведение ремонта у заказчика;</span></li>
            <li><span>склад готовой продукции и склад расходных материалов и запасных частей. Наличие складов расходных материалов в Москве, Санкт-Петербурге, Самаре и других городах России.</span></li>
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
  </div>
</div>
@endsection