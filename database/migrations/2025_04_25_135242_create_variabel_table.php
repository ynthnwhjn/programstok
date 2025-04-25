<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariabelTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('variabel', function (Blueprint $table) {
         $table->id();
         $table->string('nama');
         $table->string('nilai')->nullable();
         $table->text('keterangan')->nullable();
         $table->timestamps();

         $table->unique(['nama', 'nilai']);
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('variabel');
   }
}
