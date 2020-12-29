@extends('layouts.layout')

@section('content')
<div class="main-content">
  <div class="bg-grey">
    <div class="container-my py-5">
      <div class="row">
        <div class="col-12 col-sm-4 d-sm-block col-md-3 ">
          <sidebar-categories :categories="{{$categoriesSidebar}}"></sidebar-categories>
        </div>
        <div class="col-12 col-sm-8">
          <h3 class="my-1">Поиск по запросу:{{$search}}</h3>
          <div class="row align-self-stretch">
            @foreach ($products as $item)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 pr-5px mb-3">
              <product :product="{{$item}}"></product>
            </div>
            @endforeach
          </div>
          @if(count($products)>0)
          <div>{{ $products->links() }}</div>
          @endif
        </div>

      </div>
    </div>
  </div>
</div>
@include('components.oneclick')
@endsection