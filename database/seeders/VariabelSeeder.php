<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariabelSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $values = [
         [
            'nama' => 'field_kode',
            'nilai' => 'kode',
            'created_at' => Carbon::now(),
         ],
         [
            'nama' => 'field_tanggal',
            'nilai' => 'tanggal',
            'created_at' => Carbon::now(),
         ],
         [
            'nama' => 'kode_belinota_prefix',
            'nilai' => 'NB/',
            'created_at' => Carbon::now(),
         ],
         [
            'nama' => 'kode_belinota_format',
            'nilai' => 'YY/MM/NNNN',
            'created_at' => Carbon::now(),
         ],
         [
            'nama' => 'kode_jualnota_prefix',
            'nilai' => 'NJ/',
            'created_at' => Carbon::now(),
         ],
         [
            'nama' => 'kode_jualnota_format',
            'nilai' => 'YY/MM/NNNN',
            'created_at' => Carbon::now(),
         ],
      ];

      DB::table('variabel')->insert($values);
   }
}
