<?php

namespace App\Http\Controllers;

use App\Repositories\BasketRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class BasketController extends Controller {
  public function index() {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'Корзина', 'href' => '/basket']];
    return view('index.basket')->with('breadcrumbs', $breadcrumbs);
  }

  public function toBasket(Request $request, BasketRepository $basketRepository, ProductRepository $productRepository) {
    $basket = $basketRepository->addProduct($request->token, $request->id, $request->count);
    $result = $productRepository->getArrayProducts($basket->toArray());
    return $result;
  }

  public function getBasketData(Request $request, BasketRepository $basketRepository, ProductRepository $productRepository, CategoryRepository $categoryRepository) {
    $basket = $basketRepository->getByToken($request->token);
    $products = $productRepository->getArrayProducts($basket->toArray());
    foreach ($products as $prod) {
      $catSub = $categoryRepository->getById($prod->category_id);
      $catMain = $categoryRepository->getById($catSub->category_id);
      $prod->parentSlug = $catMain->slug . '/' . $catSub->slug;
    }
    return $products;
  }

  public function updateProductInBasket(Request $request, BasketRepository $basketRepository, ProductRepository $productRepository){
    $basket = $basketRepository->addProduct($request->token, $request->id, $request->count, true);
    $result = $productRepository->getArrayProducts($basket->toArray());
    return $result;
  }

  public function deleteProductInBasket(Request $request, BasketRepository $basketRepository, ProductRepository $productRepository){
    $basket = $basketRepository->deleteProduct($request->token, $request->id);
    $result = $productRepository->getArrayProducts($basket->toArray());
    return $result;;
  }

  public function upload(Request $request) {
    $path = $request->file('file')->store('public/z_files');
    return $path;
  }
}
