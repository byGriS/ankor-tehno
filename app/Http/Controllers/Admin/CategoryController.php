<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller {
  public function index(CategoryRepository $categoryRepository) {
    $categories = $categoryRepository->getAllMainWithChilds();
    return view('admin.categories')->with('categories', $categories);
  }
  public function store($id, Request $request, CategoryRepository $categoryRepository){
    return $categoryRepository->store($id, $request->all());
  }
}
