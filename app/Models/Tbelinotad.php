<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tbelinotad extends Model
{
   use HasFactory, SoftDeletes;

   protected $table = 'tbelinotad';
   protected $guarded = [
      'barang',
   ];

   public function barang()
   {
      return $this->hasOne(Mbarang::class, 'id', 'barang_id');
   }
}
