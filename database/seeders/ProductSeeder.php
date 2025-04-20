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
      // DB::beginTransaction();

      $items = file_get_contents(storage_path('app/tokopedia_lenovo_official_2025_04_20.json'));
      $items = json_decode($items);

      $values = [];
      foreach ($items as $row) {
         $values[] = [
            'nama' => $row->name,
            'harga_jual' => str_replace(['Rp', '.'], '', $row->price->text_idr),
            'created_at' => Carbon::now(),
         ];
      }

      DB::table('mbarang')->insert($values);

      // try {
      //    $values = [];
      //    foreach ($items as $row) {
      //       $values[] = [
      //          'namas' => $row->names,
      //          'harga_jual' => str_replace(['Rp', '.'], '', $row->price->text_idr),
      //          'created_at' => Carbon::now(),
      //       ];
      //    }

      //    DB::table('mbarang')->insert($values);

      //    DB::commit();
      // } catch (\Exception $e) {
      //    DB::rollBack();
      // }
   }
}
