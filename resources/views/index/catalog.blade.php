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
          @if ($category!=null)
          <h1 class="text-left">{{$category->title}}</h1>
          @endif
          <div class="row align-self-stretch">
            @foreach($categories as $elem)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 pr-5px">
              <category :category="{{$elem}}"></category>
            </div>
            @endforeach
          </div>
          @if (count($categories)>0 && count($products)>0)
          <hr/>
          @endif
          <div class="row align-self-stretch">
            @foreach ($products as $item)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 pr-5px mb-3">
              <product :product="{{$item}}"></product>
            </div>
            @endforeach
          </div>
          @if(count($products)>0)
          <div>{{ $products->appends(Request::all())->links() }}</div>
          @endif
          
          @if ($category!=null)
          <div class="section-context pt-5">
            <h2>{{$category->context_title}}</h2>
            <div>{!!$category->context_body!!}</div>
          </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</div>
@include('components.oneclick')
@endsection

@if ($category!=null)
@section('title')
{{$category->seo_title}}
@endsection

@section('description')
{{$category->seo_description}}
@endsection
@endif