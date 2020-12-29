<?php

namespace App\Providers;

use App\Models\ShopInfo;
use App\Repositories\CategoryRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider {
  public function register() {
    //
  }

  public function boot(CategoryRepository $categoryRepository) {
    $shopInfo = ShopInfo::all_slugArray();
    View::share('shopInfo', $shopInfo);
    $categoriesMain = $categoryRepository->getOnlyMain();
    View::share('categoriesMain', $categoriesMain);
    Paginator::useBootstrap();
  }
}
