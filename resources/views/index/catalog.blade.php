@extends('layouts.layout')

@section('content')
@include('components.breadcrumb')
<div class="main-content">
  <div class="bg-grey">
    <div class="container-my py-5">
      <div class="row">
        <div class="col-12 col-sm-4 d-sm-block col-md-3">
          @if($showCategories)
          <sidebar-categories :categories="{{$categoriesSidebar}}"></sidebar-categories>
          @else
          <sidebar-filter :properties="{{json_encode($filterProperties)}}" :cur_filter="{{json_encode($curFilter)}}" :prods_manufcturer="{{$manufacturer}}"></sidebar-filter>
          @endif
        </div>
        <div class="col-12 col-sm-8">
          <div class="row align-self-stretch">
            @foreach($categories as $category)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 pr-5px">
              <category :category="{{$category}}"></category>
            </div>
            @endforeach
          </div>
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