<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller {
  public function index(CategoryRepository $categoryRepository) {
    $categoriesMain = $categoryRepository->byId(null);
    return view('admin.products')->with(compact('categoriesMain'));
  }

  public function getCateoriesById(Request $request, CategoryRepository $categoryRepository){
    $categoriesMain = $categoryRepository->byId($request->id);
    return $categoriesMain;
  }

  public function getProductsByCategoryId($categoryId, ProductRepository $productRepository){
    $products = $productRepository->getByCategoryId($categoryId);
    return $products->toJson();
  }

  public function setPrice(Request $request, ProductRepository $productRepository){
    $productRepository->savePrice($request->product);
    return true;
  }
}
