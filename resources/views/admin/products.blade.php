@extends('admin.layout')

@section('content')
<div class="p-2">
  <h3>Товары</h3>
  <div class="filter">
    <form action="{{route('admin.products')}}" method="GET" class="pt-2">
      <div class="d-flex">
        <div class="flex-fill pe-3">
          <input class="form-control form-control-sm" name="search" placeholder="Поиск" value="{{$filter['old']['search'] ?? ''}}" />
        </div>
        <div class="d-flex">
          <button class="btn btn-sm btn-primary ms-1">Применить</button>
          <a class="btn btn-sm btn-warning ms-1 d-flex align-items-center" href="{{route('admin.products')}}">Сбросить</a>
        </div>
      </div>
    </form>
    <hr />
  </div>

  <div class="my-2 content-table-wrap">
    <div class="content-table-header d-flex">
      <div class="col-10 text-center">Наименование</div>
      <div class="col-2 text-center">Цена</div>
    </div>
    <div class="content-table-body">
      @foreach($products as $product)
      <product-row-data :product="{{$product}}"></product-row-data>
      @endforeach
      {{ $products->appends(request()->all())->links() }}
    </div>
  </div>
</div>
@endsection