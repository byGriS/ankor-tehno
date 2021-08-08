<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;

class SitemapController extends Controller {
  public function index(Request $request) {
    set_time_limit(-1);
    $urls = array();
    array_push($urls, "");
    array_push($urls, "catalog");
    array_push($urls, "services");
    array_push($urls, "about");
    array_push($urls, "contacts");

    $categories = Category::all();
    foreach ($categories as $category) {
      $path = 'catalog' . $this->getCategoryPath($category, '');
      array_push($urls, $path);
      foreach ($category->products as $product) {
        array_push($urls, $path . '/' . $product->id);
      }
    }
    $urls = array_map(function ($item) {
      return 'https://ankor-tehno.ru/' . $item;
    }, $urls);
    $sitemapData = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $url) {
      $sitemapData .= "<url>" . PHP_EOL;
      $sitemapData .= "<loc>$url</loc>" . PHP_EOL .
        "<lastmod>" . (new DateTime('now'))->format('c') . "</lastmod>" . PHP_EOL .
        "<changefreq>monthly</changefreq>" . PHP_EOL .
        "<priority>0.25</priority>";
      $sitemapData .= "</url>" . PHP_EOL;
    }
    $sitemapData .= '</urlset>';
    file_put_contents('sitemap.xml', $sitemapData);
    return true;
    //return response()->view('sitemap-xml', compact('urls'))->header('Content-Type', 'text/xml');
  }

  protected function getCategoryPath($category, $result) {
    $result = '/' . $category->slug . $result;
    if ($category->category != null) {
      $result = $this->getCategoryPath($category->category, $result);
    }
    return $result;
  }

  public function turbo() {
    set_time_limit(-1);
    $categories = Category::select('id', 'title', 'category_id')->with(['products' => function ($q) {
      $q->select('id', 'title', 'category_id');
    }])->get();
    $products = array();
    foreach ($categories as $category) {
      $path = 'catalog' . $this->getCategoryPath($category, '');
      foreach ($category->products as $product) {
        $product->path = 'https://ankor-tehno.ru/' . $path . $product->id;
        array_push($products, $product);
      }
    }
    return view('turbo')->with('categories', $categories)->with('products', $products);
  }

  public function turboGenerate() {
    $categories = Category::select('id', 'title', 'category_id')->with(['products' => function ($q) {
      $q->select('id', 'title', 'category_id');
    }])->get();
    $products = array();
    foreach ($categories as $category) {
      $path = 'catalog' . $this->getCategoryPath($category, '');
      foreach ($category->products as $product) {
        $product->path = 'https://ankor-tehno.ru/' . $path . $product->id;
        array_push($products, $product);
      }
    }
    $sitemapData = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemapData .= "<yml_catalog date=" . date('Y-m-d\Th:i:s') . ">" . PHP_EOL;
    $sitemapData .= "<shop>" . PHP_EOL;
    $sitemapData .= "<name>Анкор-Техно</name>" . PHP_EOL;
    $sitemapData .= "<company>Анкор-Техно</company>" . PHP_EOL;
    $sitemapData .= "<url>https://ankor-tehno.ru/</url>" . PHP_EOL;
    $sitemapData .= '<currencies><currency id="RUR" rate="1"/></currencies>' . PHP_EOL;
    $sitemapData .= '<categories>' . PHP_EOL;
    foreach ($categories as $category) {
      $sitemapData .= '<category id="' . $category->id . '" ';
      if (isset($category->category))
        $sitemapData .= 'parentId="' . $category->category->id . '" ';
      $sitemapData .= '>' . $category->title . '</category>' . PHP_EOL;
    }
    $sitemapData .= '</categories>' . PHP_EOL;
    $sitemapData .= '<offers>' . PHP_EOL;
    foreach($products as $product){
      $sitemapData .= '<offer id="' . $product->id . '">'.PHP_EOL;
      $sitemapData .= '<name>' . $product->title . '</name>'.PHP_EOL;
      $sitemapData .= '<url>' . $product->path . '</url>'.PHP_EOL;
      $sitemapData .= '<categoryId>' . $product->category_id . '</categoryId>'.PHP_EOL;
      $sitemapData .= '</offer>'.PHP_EOL;
    }
    $sitemapData .= '</offers>' . PHP_EOL;
    $sitemapData .= '</shop>' . PHP_EOL;    
    $sitemapData .= '</yml_catalog>';
    file_put_contents('price.yml', $sitemapData);
    return true;
  }
}
