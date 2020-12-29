<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopInfo extends Model {
  use HasFactory;

  public static function all_slugArray(){
    $shopInfo = ShopInfo::all();
    $result = array();
    foreach($shopInfo as $item){
      $result[$item->slug] = $item;
    }
    return $result;
  }
}
