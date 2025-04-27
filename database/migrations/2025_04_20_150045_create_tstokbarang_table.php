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
         $table->string('transaksi_kode')->default('');
         $table->bigInteger('gudang_id');
         $table->bigInteger('barang_id');
         $table->decimal('jumlah', 15, 4)->default(0);
         $table->decimal('harga', 15, 4)->default(0);
         $table->enum('jenis_transaksi', ['JualNota', 'BeliNota'])->default('BeliNota');
         $table->dateTime('tanggal');
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
      Schema::dropIfExists('tstokbarang');
   }
}
