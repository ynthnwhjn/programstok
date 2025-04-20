<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTjualnotadTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('tjualnotad', function (Blueprint $table) {
         $table->id();
         $table->bigInteger('jualnotah_id');
         $table->bigInteger('barang_id');
         $table->decimal('jumlah', 15, 4)->default(0);
         $table->decimal('harga', 15, 4)->default(0);
         $table->decimal('subtotal', 15, 4)->default(0);
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('tjualnotad');
   }
}
