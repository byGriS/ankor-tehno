<?php

namespace App\Repositories;

use App\Models\Basket;

class BasketRepository extends BaseRepository {

  public function __construct(Basket $model) {
    parent::__construct($model);
  }

  public function getByToken($token) {
    $result = $this->model->whereToken($token)->first();
    if ($result == null) {
      $result = new Basket;
      $result->token = $token;
      $result->save();
    }
    return $result;
  }

  public function addProduct($token, $product_id, $product_count, $update = false) {
    $basket = $this->getByToken($token);
    if ($basket->payload != null) {
      $products = explode('|', $basket->payload);
    } else {
      $products = array();
    }
    $newProduct = true;
    for ($i = 0; $i < count($products); $i++) {
      $product_data = explode('-', $products[$i]);
      if ($product_data[0] == $product_id) {
        $product_data[1] = ($update?0:$product_data[1]) + $product_count;
        $products[$i] = $product_data[0] . '-' . $product_data[1];
        $newProduct = false;
      }
    }
    if ($newProduct)
      array_push($products, $product_id . '-' . $product_count);
    $basket->payload = implode('|', $products);
    $basket->save();
    return $basket;
  }  

  public function deleteProduct($token, $product_id){
    $basket = $this->getByToken($token);
    if ($basket->payload != null) {
      $products = explode('|', $basket->payload);
    } else {
      $products = array();
    }
    for ($i = 0; $i < count($products); $i++) {
      $product_data = explode('-', $products[$i]);
      if ($product_data[0] == $product_id) {
        unset($products[$i]);
      }
    }
    $basket->payload = implode('|', $products);
    $basket->save();
    return $basket;
  }
}
