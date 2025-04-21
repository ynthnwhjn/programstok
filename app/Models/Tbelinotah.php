<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbelinotah extends Model
{
   use HasFactory;

   protected $table = 'tbelinotah';
   protected $guarded = [];

   public function supplier()
   {
      return $this->hasOne(Mcustsupp::class, 'supplier_id', 'id');
   }
}
