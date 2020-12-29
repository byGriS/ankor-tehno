<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopInfoSeeder extends Seeder {
  public function run() {
    DB::table('shop_infos')->insert([
      'title' => 'Название сайта',
      'slug' => 'name',
      'value' => 'ООО «Анкор-Техно-С»'
    ]);
    DB::table('shop_infos')->insert([
      'title' => 'Заголовок в шапке',
      'slug' => 'header_title',
      'value' => 'Продажа строительного и промышленного оборудования'
    ]);
    DB::table('shop_infos')->insert([
      'title' => 'Телефон1',
      'slug' => 'phone1',
      'value' => '8 (846) 277-17-78'
    ]);
    DB::table('shop_infos')->insert([
      'title' => 'Телефон2',
      'slug' => 'phone2',
      'value' => '8 (917) 162-51-16'
    ]);
    DB::table('shop_infos')->insert([
      'title' => 'Адрес',
      'slug' => 'address',
      'value' => 'г. Самара, ул. Томашевский тупик, 3а'
    ]);
    DB::table('shop_infos')->insert([
      'title' => 'Email',
      'slug' => 'email',
      'value' => 'ankor-tehno@mail.ru'
    ]);
    DB::table('shop_infos')->insert([
      'title' => 'logo путь',
      'slug' => 'logo_src',
      'value' => '/images/logo.svg'
    ]);
  }
}
