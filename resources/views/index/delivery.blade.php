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
          <h3>Доставка по Самаре – при покупке от 3000 бесплатно</h3>
          <p> Как только деньги поступили на расчетный счет нашей компании, то товар будет доставлен «до двери» в оговоренное время и место.</p>
          <h3>Доставка по России</h3>
          <p>Доставка осуществляется до любой транспортной компании, находящейся в Самаре.</p>
          <p>Отгрузка осуществляется только по 100% предоплате. Транспортные расходы выбранной компании оплачивает покупатель (или по договоренности). Также в транспортной компании можно оформить страховку груза.</p>
          <p><strong>Форма оплаты:</strong> безналичный расчет.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection