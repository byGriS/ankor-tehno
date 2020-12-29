<div>
  <p>Новый заказ в интернет-магазине</p>
  <p>Номер заказа: <strong>{{$order['id']}}</strong></p>
  <p>Имя: <strong>{{$order['name']}}</strong></p>
  <p>Email: <strong>{{$order['email']}}</strong></p>  
  <p>Телефон: <strong>{{$order['phone']}}</strong></p>
  <p>Комментарий: <strong>{{$order['comment']}}</strong></p>
  <p>Список товаров:</p>
  @for ($i = 0; $i < count($products); $i++) 
    <p>{{($i+1)}}. {{$products[$i]['title']}} ({{$products[$i]['count']}} шт.) - id товара: {{$products[$i]['id']}}</p>
  @endfor 
</div>