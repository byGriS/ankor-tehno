<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Repositories\BasketRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller {
  public function oneClick(Request $request, OrderRepository $orderRepository, ProductRepository $productRepository) {
    $order = $orderRepository->createOrderOneClick($request->all());
    $order->save();
    $product = $productRepository->getById($request->product_id);
    $product->count = $request->product_count;
    $products = [];
    array_push($products, $product->toArray());
    Mail::to("sale@icmy.ru")->send(new OrderShipped($order, $products));
    return redirect()->back()->withErrors(['Заказ успешно оформлен!']);
  }

  public function confirmOrder(Request $request, OrderRepository $orderRepository, ProductRepository $productRepository, BasketRepository $basketRepository){
    $basket = $basketRepository->getByToken($request->token);
    $products = $productRepository->getArrayProducts($basket->toArray());
    $order = $orderRepository->createOrder($request->all(), $products);
    $order->save();
    $basket->payload = "";
    $basket->save();
    Mail::to("gris_gc@mail.ru")->send(new OrderShipped($order, $products));
    return redirect('/')->withErrors(['Заказ успешно оформлен!']);
  }
}
