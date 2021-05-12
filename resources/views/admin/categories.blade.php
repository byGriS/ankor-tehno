@extends('admin.layout')

@section('content')
  <admin-categories-index :categories-input="{{$categories}}"></admin-categories-index>
@endsection