<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    foreach($categories as $category){
      $path = 'catalog'.$this->getCategoryPath($category, '');
      array_push($urls, $path);
      foreach($category->products as $product){
        array_push($urls, $path.'/'.$product->id);
      }
    }
    $urls = array_map(function ($item) {
      return 'https://ankor-tehno.ru/' . $item;
    }, $urls);
    $sitemapData = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach($urls as $url){
      $sitemapData .= "<url>".PHP_EOL;
      $sitemapData .= "<loc>$url</loc>".PHP_EOL.
      "<lastmod>".(new DateTime('now'))->format('c')."</lastmod>".PHP_EOL.
      "<changefreq>monthly</changefreq>".PHP_EOL.
      "<priority>0.25</priority>";
      $sitemapData .= "</url>".PHP_EOL;
    }




    $sitemapData .= '</urlset>';
    file_put_contents('sitemap.xml',$sitemapData);
    return true;
    //return response()->view('sitemap-xml', compact('urls'))->header('Content-Type', 'text/xml');
  }

  protected function getCategoryPath($category, $result){
    $result = '/'.$category->slug.$result;
    if ($category->category != null){
      $result = $this->getCategoryPath($category->category, $result);
    }
    return $result;
  }
}
