@extends('admin.layout')

@section('content')
  <admin-products-index :categories-main="{{$categoriesMain}}"></admin-products-index>
@endsection