<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class IndexController extends Controller {
  public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository) {
    $productsStock = $productRepository->getStock();
    foreach ($productsStock as $prod) {
      $prod->parentSlug = $categoryRepository->getFullSlug($prod->category_id);
    }
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();
    return view('index.index')->with('productsStock', $productsStock)->with('categoriesSidebar', $categoriesSidebar);
  }

  public function abount(CategoryRepository $categoryRepository) {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'О компании', 'href' => '/about']];
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();
    return view('index.about')->with('breadcrumbs', $breadcrumbs)->with('categoriesSidebar', $categoriesSidebar);
  }

  public function contacts() {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'Контакты', 'href' => '/contacts']];
    return view('index.contacts')->with('breadcrumbs', $breadcrumbs);
  }

  public function delivery(CategoryRepository $categoryRepository) {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'Доставка', 'href' => '/delivery']];
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();
    return view('index.delivery')->with('breadcrumbs', $breadcrumbs)->with('categoriesSidebar', $categoriesSidebar);
  }

  public function services(CategoryRepository $categoryRepository) {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'Услуги', 'href' => '/services']];
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();
    return view('index.services')->with('breadcrumbs', $breadcrumbs)->with('categoriesSidebar', $categoriesSidebar);
  }
}
