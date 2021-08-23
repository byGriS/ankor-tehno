<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<yml_catalog date="{{date('Y-m-d\Th:i:s')}}">
  <shop>
      <name>Анкор-Техно</name>
      <company>Анкор-Техно</company>
      <url>https://ankor-tehno.ru/</url>
      <currencies><currency id="RUR" rate="1"/></currencies>
      <categories>
        @foreach($categories as $category)
          <category id="{{$category->id}}" @isset($category->category) parentId="{{$category->category->id}}"  @endisset>{{$category->title}}</category>
        @endforeach
      </categories>
     
      <offers>
        @foreach($products as $product)
          <offer id="{{$product->id}}">
              <name>{{str_replace('&','&amp;',$product->title)}}</name>
              <url>{{$product->path}}</url>
              <categoryId>{{$product->category_id}}</categoryId>
          </offer>
          @endforeach
      </offers>
  </shop>
</yml_catalog>