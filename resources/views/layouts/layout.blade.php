<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="robots" content="index, follow"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Акнор-Техно')</title>
  <link rel="canonical" href="{{Request::url()}}">
  <meta name="description" content="@yield('description')">
  <meta name="csrf-token" content="{{csrf_token()}}">
  {{-- <link rel="stylesheet" href="{{asset('css/index.css')}}"> --}}
  <link rel="stylesheet" href="/css/index.css">
  <link rel="stylesheet" href="/css/myriadpro-cond.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/default.css">
  <link rel="stylesheet" href="/css/nivo-slider.css">
  <link rel="icon" href="/favicon.svg">
</head>

<body>
  <div id="app" class="content-wrap">
    @include('static.header')
    @include('static.menu')
    @yield('content')
    {{-- @include('static.footer-banners') --}}
    <brand-slider></brand-slider>
    @include('static.footer')
  </div>
</body>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
{{-- <script src={{asset('js/app.js')}}></script> --}}
<script src='/js/app.js'></script>
<script src='/js/jquery.nivo.slider.pack.js'></script>

@if($errors->any() && $errors->messages()[0][0] != 'Данная почта незарегистрирована' && $errors->messages()[0][0] != 'Неверный пароль')
<div class="modal fade" id="successOneClickModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title">Специалист отдела продаж сформирует для вас самое выгодное предложение</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <h4>{{$errors->first()}}</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $("#successOneClickModal").modal({});
</script>
@endif

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
  m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
  
  ym(79991455, "init", {
  clickmap:true,
  trackLinks:true,
  accurateTrackBounce:true,
  webvisor:true
  });
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/79991455" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4WDYW44Y86"></script>
<script>
  window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-4WDYW44Y86');
</script>

</html>