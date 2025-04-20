<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbelinotahTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('tbelinotah', function (Blueprint $table) {
         $table->id();
         $table->bigInteger('supplier_id');
         $table->date('tanggal');
         $table->string('kode');
         $table->decimal('subtotal', 15, 4)->default(0);
         $table->decimal('total', 15, 4)->default(0);
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
      Schema::dropIfExists('tbelinotah');
   }
}
