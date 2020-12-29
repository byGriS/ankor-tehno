<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model {
  use HasFactory;

  public $timestamps = false;

  
  public function products(){
    return $this->belongsToMany('App\Models\Product')->withPivot('value'); 
  }
}
