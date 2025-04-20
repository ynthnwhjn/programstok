<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcustsuppTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('mcustsupp', function (Blueprint $table) {
         $table->id();
         $table->string('nama');
         $table->enum('role', ['Customer', 'Supplier'])->default('Customer');
         $table->timestamps();

         $table->unique(['nama', 'role']);
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('mcustsupp');
   }
}
