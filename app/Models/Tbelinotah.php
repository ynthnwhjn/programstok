<?php

namespace App\Models;

use App\Observers\CrudObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbelinotah extends Model
{
   use HasFactory;

   public $autonumberPrefix = 'kode_belinota_prefix';
   public $autonumberFormat = 'kode_belinota_format';

   protected $table = 'tbelinotah';
   protected $guarded = [
      'barang_id',
   ];

   protected static function boot()
   {
      parent::boot();
      self::observe(CrudObserver::class);
   }

   public function supplier()
   {
      return $this->hasOne(Mcustsupp::class, 'id', 'supplier_id');
   }

   public function autonumberOptions()
   {
      return [
         'prefix' => 'kode_belinota_prefix',
         'format' => 'kode_belinota_format',
      ];
   }
}
