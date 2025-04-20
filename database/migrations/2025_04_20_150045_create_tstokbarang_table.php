<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTstokbarangTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('tstokbarang', function (Blueprint $table) {
         $table->id();
         $table->bigInteger('transaksih_id');
         $table->bigInteger('transaksid_id');
         $table->bigInteger('barang_id');
         $table->decimal('jumlah', 15, 4)->default(0);
         $table->enum('jenis_transaksi', ['JualNota', 'BeliNota'])->default('BeliNota');
         $table->dateTime('tanggal');
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
      Schema::dropIfExists('tstokbarang');
   }
}
