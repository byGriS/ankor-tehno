<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository {

  public function __construct(Category $model) {
    parent::__construct($model);
  }

  public function getAllMainWithChilds() {
    $categories = $this->model->whereCategoryId(null)->orderBy('title','asc')->with('childs')->with('image')->with('childs.childs')->get();
    //dd($categories);
    return $categories;
  }

  public function byId($id) {
    $categories = $this->model->whereCategoryId($id)->with('products')->first();
    return $categories;
  }

  public function getById($id) {
    $category = $this->model->whereId($id)->first();
    return $category;
  }

  public function getOnlyMain() {
    $result = $this->model->whereCategoryId(null)->orderBy('title','asc')->get();
    return $result;
  }

  public function getBySlug($slug){
    $result = $this->model->whereSlug($slug)->first();
    return $result;
  }

  public function getBySlugsWithChildsProducts($slugs) {
    $result = $this->model;
    for ($i = 0; $i < count($slugs); $i++) {
      if ($i == (count($slugs) - 1)) {
        $result = $result->whereSlug($slugs[$i])
        ->with('childs')->with('childs.image')->with('childs.childs')->first();
      } else {
        $result = $result->whereSlug($slugs[$i])->first()->childs();
      }
    }
    return $result;
  }

  public function getFullSlug($category_id){
    $catProd = $this->model->whereId($category_id)->first();
    $slug = $catProd->slug;
    $category = $catProd;
    while ($category->category_id != null){
      $category = $this->model->whereId($category->category_id)->first();
      $slug = $category->slug . '/' . $slug;
    }
    
    return $slug;
  }
}
