<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable {
  use Queueable, SerializesModels;

  protected $order;
  protected $products;

  public function __construct($order, $products) {
    $this->order = $order;
    $this->products = $products;
  }

  public function build() {
    return $this->from(env('MAIL_FROM_ADDRESS'))
    ->view('emails.neworder')
    ->subject('Заказ '.$this->order->id)
    ->with(['order' => $this->order, 'products'=>$this->products])
    ->attach(env('APP_URL').'/public'.str_replace ('public/', '' ,$this->order->requisites));
  }
}
