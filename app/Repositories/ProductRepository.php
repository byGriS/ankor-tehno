<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Property;

class ProductRepository extends BaseRepository {

  public function __construct(Product $model) {
    parent::__construct($model);
  }

  public function getStock() {
    $result = $this->model->whereShowInMain(1)->with('images')->with('properties')->get();
    return $result;
  }

  public function getById($id) {
    $result = $this->model->whereId($id)->with('images')->with('properties')->first();
    return $result;
  }

  public function getArrayProducts($basketData) {
    $productsId = array();
    $prodExplode = explode('|', $basketData['payload']);
    foreach ($prodExplode as $prod) {
      array_push($productsId, explode('-', $prod)[0]);
    }
    $products = $this->model->whereIn('id', $productsId)->with('images')->get()->map(function ($elem, $index) use ($prodExplode) {
      $elem->count = intval(explode('-', $prodExplode[$index])[1]);
      return $elem;
    });
    return $products;
  }

  public function search($search) {
    $products = $this->model->where('title', 'like', '%' . $search . '%')->with('images')->with('properties')->paginate(15);
    return $products;
  }

  public function getPropertiesForFilter($filterCatId) {
    $result = array();
    $countProducts = $this->model->whereCategoryId($filterCatId)->get()->count();
    $allProperties = Property::whereHas('products', function ($q) use ($filterCatId) {
      $q->whereCategoryId($filterCatId);
    })->get();
    foreach ($allProperties as $prop) {
      $products = $prop->products()->whereCategoryId($filterCatId)->get();
      if (count($products) >= ($countProducts / 2.0)) {
        $values = array();
        foreach($products as $prod){
          array_push($values, $prod->pivot->value);
        }
        $values = array_unique($values);
        array_push($result, array($prop->title, $prop->slug, $values));
      }
    }
    return $result;
  }

  public function getManufacturers($cat_id){
    $result = $this->model->whereCategoryId($cat_id)->groupBy('manufacturer')->select('manufacturer')->get();
    return $result;
  }
}
