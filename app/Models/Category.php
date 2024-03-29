<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
  use HasFactory;

  public $with = ['category'];

  public function category() {
    return $this->belongsTo('App\Models\Category');
  }

  public function image() {
    return $this->belongsTo('App\Models\Image');
  }

  public function childs() {
    return $this->hasMany('App\Models\Category');
  }

  public function products() {
    return $this->hasMany('App\Models\Product');
  }
}
