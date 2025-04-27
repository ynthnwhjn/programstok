<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbelinotadTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('tbelinotad', function (Blueprint $table) {
         $table->id();
         $table->bigInteger('belinotah_id');
         $table->bigInteger('barang_id');
         $table->decimal('jumlah', 15, 4)->default(0);
         $table->decimal('harga', 15, 4)->default(0);
         $table->decimal('subtotal', 15, 4)->default(0);
         $table->timestamps();
         $table->timestamp('deleted_at')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('tbelinotad');
   }
}
