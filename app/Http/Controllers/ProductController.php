<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller {
  public function index(Request $request, $categorySlugs = null, CategoryRepository $categoryRepository, ProductRepository $productRepository) {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'Каталог', 'href' => '/catalog']];
    $products = array();
    $filterProperties = "";
    $manufacturer = [];
    $showCategories = true;
    if ($categorySlugs != null) {
      $categorySlugs = explode('/', $categorySlugs);
      $category = $categoryRepository->getBySlugsWithChildsProducts($categorySlugs);
      foreach ($categorySlugs as $key => $slug) {
        $catBySlug = $categoryRepository->getBySlug($slug);
        $href = "/catalog";
        for ($i = 0; $i <= $key; $i++) {
          $href .= '/' . $categorySlugs[$i];
        }
        array_push($breadcrumbs, array('title' => $catBySlug->title, 'href' => $href));
      }
      /* Filter */
      $products = $category->products();
      foreach ($request->all() as $key => $filter) {
        if ($key == 'page')
          continue;
        if ($key == "manufacturer"){
          $products = $products->where('manufacturer',$filter);
          continue;
        }
        $products = $products->whereHas('properties', function ($q) use ($key, $filter) {
          $q->where('slug', 'like', '%' . $key . '%');
          $q->where(function($q2) use ($filter){
            foreach($filter as $elem)
            $q2->orWhere('product_property.value', 'like', '%' . $elem . '%');
          });
          
        });
        //dd($products->getBindings());
      }
      $products = $products->with('images')->with('properties')->paginate(15);
      /*****/
      foreach ($products as $prod) {
        $prod->parentSlug = implode('/', $categorySlugs);
      }
      $categories = $category->childs;
      foreach ($categories as $cat) {
        $cat->parentSlug = implode('/', $categorySlugs);
      }
      if (count($categories) == 0)
        $showCategories = false;
    } else {
      $category = null;
      $categories = $categoryRepository->getAllMainWithChilds();
    }
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();

    /* Data for filters*/
    if (count($categories) == 0) {
      $filterCat = $categoryRepository->getById($category->id);
      $filterProperties = $productRepository->getPropertiesForFilter($filterCat->id);
      $manufacturer = $productRepository->getManufacturers($category->id);
    }
    /* */
    return view('index.catalog')->with('breadcrumbs', $breadcrumbs)
      ->with('category', $category)
      ->with('categories', $categories)
      ->with('products', $products)
      ->with('categoriesSidebar', $categoriesSidebar)
      ->with('showCategories', $showCategories)
      ->with('filterProperties', $filterProperties)
      ->with('curFilter', $request->all())
      ->with('manufacturer',$manufacturer);
  }

  public function product($categorySlugs = null, $product_id, ProductRepository $productRepository, CategoryRepository $categoryRepository) {
    $breadcrumbs = [['title' => 'Главная', 'href' => '/'], ['title' => 'Каталог', 'href' => '/catalog']];
    $categorySlugs = explode('/', $categorySlugs);
    foreach ($categorySlugs as $key => $slug) {
      $catBySlug = $categoryRepository->getBySlug($slug);
      $href = "/catalog";
      for ($i = 0; $i <= $key; $i++) {
        $href .= '/' . $categorySlugs[$i];
      }
      array_push($breadcrumbs, array('title' => $catBySlug->title, 'href' => $href));
    }
    $product = $productRepository->getById($product_id);
    array_push($breadcrumbs, array('title' => $product->title, 'href' => $product->id));
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();
    return view('index.product')->with('breadcrumbs', $breadcrumbs)->with('product', $product)->with('categoriesSidebar', $categoriesSidebar);
  }

  public function search(Request $request,  ProductRepository $productRepository, CategoryRepository $categoryRepository) {
    $products = $productRepository->search($request->search);
    foreach ($products as $prod) {
      $prod->parentSlug = $categoryRepository->getFullSlug($prod->category_id);
    }
    $categoriesSidebar = $categoryRepository->getAllMainWithChilds();
    return view('index.search')->with('products', $products)->with('categoriesSidebar', $categoriesSidebar)->with('search', $request->search);
  }
}
