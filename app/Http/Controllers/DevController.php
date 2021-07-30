<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class DevController extends Controller {

  public function test(){
    $product = Product::first();
    dd($product);
  }

  public function refreshdb(Request $request) {
    return false;
    if ($request->catalog == null)
     return "error";
    $mainCategories = Storage::disk('public')->directories();
    $this->parseDirs($mainCategories, null, $request->catalog, true);
    return redirect('/');
  }

  public function parseDirs($directions, $parentCategory, $catalog, $firstLoop) {
    return false;
    foreach ($directions as $direction) {
      if ($firstLoop && $direction != $catalog)
        continue;
      $dirs = explode('/', $direction);
      $slugDir = '';
      foreach ($dirs as $dir)
        $slugDir .= ('/' . Str::slug($dir));
      $slugDir .= '/';
      if (ctype_digit($dirs[count($dirs) - 1])) {
        $product = new Product;
        try {
          $product->title = explode(' [', Storage::disk('public')->get($direction . '/' . 'title.txt'))[0];
        } catch (Throwable $e) {
          continue;
        }
        if (Storage::disk('public')->exists($direction . '/' . 'manufacturer.txt')) {
          $product->manufacturer = explode(' [', Storage::disk('public')->get($direction . '/' . 'manufacturer.txt'))[0];
        }
        $product->category_id = $parentCategory->id;
        $product->save();
        $product->slug = $parentCategory->id . '-' . $product->id;
        $product->save();

        $properties = file('storage/' . $direction . '/' . 'props.txt'); //Storage::disk('public')->get($direction.'/'.'props.txt');
        $property = null;
        for ($i = 0; $i < count($properties); $i++) {
          if (($i % 2) == 0) {
            $slugProp = Str::slug($properties[$i]);
            $property = Property::whereSlug($slugProp)->first();
            if ($property == null) {
              $property = new Property;
              $property->title = $properties[$i];
              $property->slug = $slugProp;
              $property->save();
            }
          } else {
            if ($property != null) {
              $product->properties()->attach($property->id, ['value' => $properties[$i]]);
            }
          }
        }
        $files = Storage::disk('public')->files($direction);
        foreach ($files as $file) {
          $explodeFile = explode('/', $file);
          $fileName =  str_replace('.png', '', $explodeFile[count($explodeFile) - 1]);
          if (ctype_digit($fileName)) {
            $image = new Image;
            $image->src = '/storage' . $slugDir .  $explodeFile[count($explodeFile) - 1];
            $product->images()->save($image);
          }
        }
      } else {
        $folder = $dirs[count($dirs) - 1];
        $image = new Image();
        $image->src = '/storage' . $slugDir . 'logo.png';
        $image->save();
        $category = new Category;
        $category->title = $folder;
        $category->slug = Str::slug($folder);
        $category->image_id = $image->id;
        $category->category_id = $parentCategory != null ? $parentCategory->id : null;
        $category->save();
        try{
          Storage::disk('public')->move($direction, $slugDir);
        } catch (Throwable $e) {
          ;
        }
        $nestedDirections = Storage::disk('public')->directories($slugDir);
        //$nestedDirections = Storage::disk('public')->directories($direction);
        $this->parseDirs($nestedDirections, $category, null, false);
      }
    }
  }

  public function set_seo_cat(){
    $categories = Category::all();
    foreach($categories as $category){
      $category->seo_title = $category->title . ': купить в Самаре, цена - магазин АНКОР-ТЕХНО';
      $category->seo_description = $category->title . ' - продажа в Самаре оптом и в розницу. Доступные цены. Доставка по всей России.';
      $category->save();
    }
  }

  public function set_seo_product(){
    $products = Product::with('category')->get();
    foreach($products as $product){
      $product->seo_title = $product->category->title . ': ' .$product->title . ' - купить в Самаре';
      $product->seo_description = $product->title . ' - продажа в Самаре оптом и в розницу. Доступные цены. Доставка по всей России.';
      $product->save();
    }
  }
}
