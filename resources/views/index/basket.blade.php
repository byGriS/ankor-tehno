@extends('layouts.layout')

@section('content')
@include('components.breadcrumb')
<div class="main-content">
  <div class="bg-grey">
    <div class="container-my py-5">
      <div class="row">
        <div class="col-12">
          <basket-detail></basket-detail>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection