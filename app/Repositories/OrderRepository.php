<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository {

  public function __construct(Order $model) {
    parent::__construct($model);
  }

  public function createOrderOneClick($data) {
    $order = new Order;
    $order->name = $data['name'];
    $order->email = $data['email'];
    $order->phone = $data['phone'];
    $order->comment = $data['comment'];
    $order->payload = $data['product_id'] . '-' . $data['product_count'];
    return $order;
  }

  public function createOrder($data, $products){
    $order = new Order;
    $order->name = $data['name'];
    $order->email = $data['email'];
    $order->phone = $data['phone'];
    $order->comment = $data['comment'];
    $order->requisites = $data['requisites'];
    foreach($products as $product){
      $order->payload .=   $product->id . '-' .$product->count . "|";
    }
    return $order;
  }
}
