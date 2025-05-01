<?php

namespace App\Models;

use App\Observers\CrudObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tjualnotah extends Model
{
   use HasFactory;

   protected $table = 'tjualnotah';
   protected $guarded = [
      'customer',
   ];

   protected static function boot()
   {
      parent::boot();
      self::observe(CrudObserver::class);
   }

   public function customer()
   {
      return $this->hasOne(Mcustsupp::class, 'id', 'customer_id');
   }

   public function salesInvoiceDetail()
   {
      return $this->hasMany(Tjualnotad::class, 'jualnotah_id', 'id');
   }

   public function autonumberOptions()
   {
      return [
         'prefix' => 'kode_jualnota_prefix',
         'format' => 'kode_jualnota_format',
      ];
   }
}
