<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMbarangTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('mbarang', function (Blueprint $table) {
         $table->id();
         $table->string('nama')->unique();
         $table->decimal('harga_beli', 15, 4)->default(0);
         $table->decimal('harga_jual', 15, 4)->default(0);
         $table->string('satuan')->nullable();
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
      Schema::dropIfExists('mbarang');
   }
}
