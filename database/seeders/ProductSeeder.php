<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $items = file_get_contents(storage_path('tokopedia_lenovo_official_2025_04_20.json'));
      $items = json_decode($items);

      $values = [];
      foreach ($items as $row) {
         $harga_jual = floatval(str_replace(['Rp', '.'], '', $row->price->text_idr));

         $values[] = [
            'nama' => $row->name,
            'harga_beli' => ($harga_jual - ($harga_jual * 5/100)),
            'harga_jual' => $harga_jual,
            'created_at' => Carbon::now(),
         ];
      }

      DB::table('mbarang')->insert($values);
   }
}
