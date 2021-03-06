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
          <h1>Услуги и сервис</h1>
          <p>Когда речь заходит об обслуживании промышленного и строительного оборудования, компания «Анкор-Техно» предлагает комплекс сервисных услуг.</p>
          <p>Мы предлагаем своим Клиентам оригинальные запасные части, гарантийное и послегарантийное обслуживание на базе сервисных договоров и специально разработанных программ. Мы преданны интересам Клиента, внимательны к пожеланиям и самым высоким требованиям, готовые всегда прийти на помощь.</p>
          <p>Нашей Компанией разработана программа сервисной поддержки Клиента с которой Вы можете ознакомиться.</p>
          <h3>ПРОГРАММА СЕРВИСНОЙ ПОДДЕРЖКИ включает: ПРЕДПРОДАЖНАЯ КОНСУЛЬТАЦИЯ</h3>
          <ul>
            <li><span>консультация и помощь в выборе</span></li>
            <li><span>предоставление нескольких вариантов, удовлетворяющих техническим требованиям клиента</span></li>
          </ul>
          <h3>ПЕРВЫЙ ПУСК</h3>
          <ul>
            <li><span>консультация сервис-инженера при первом пуске</span></li>
            <li><span>проверка правильности подключения</span></li>
            <li><span>диагностика и проверка работы</span></li>
            <li><span>настройка блока управления</span></li>
            <li><span>рекомендации по изменению условий эксплуатации</span></li>
            <li><span>первичное обучение обслуживающего персонала</span></li>
          </ul>
          <h3>ОБУЧЕНИЕ СПЕЦИАЛИСТОВ</h3>
          <ul>
            <li><span>обучение сервисных специалистов на базе центральной сервисной службы</span></li>
            <li><span>ремонты и первые пуски совместно с опытными сервис-инженерами</span></li>
            <li><span>предоставление сервисной информации</span></li>
          </ul>
          <h3>ПОСЛЕПРОДАЖНОЕ СОПРОВОЖДЕНИЕ</h3>
          <ul>
            <li><span>гарантийный и постгарантийный ремонт и обслуживание</span></li>
            <li><span>техническое обслуживание и проведение планового ТО</span></li>
            <li><span>консультация и рекомендации по эксплуатации - за это мы не берем денег!</span></li>
          </ul>
          Наши Клиенты: ЗАО «Возрождение», ООО «НефтеГазИнвест» ОАО «Роснефть» (НК НПЗ), ОАО «РЖД», ОАО «Приволжскнефтепровод», ОАО «Волгасинтез», ЗАО «АРГО Моторс», ОАО «Хлеб», ООО «СВЗМК», ООО «Нефтестрой» ОАО «КТЦ Металлоконструкции» и.т.д.
        </div>
      </div>
    </div>
  </div>
</div>
@include('components.oneclick')
@endsection