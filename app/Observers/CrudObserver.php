<?php

namespace App\Observers;

use App\Models\Variabel;
use App\Traits\GenerateKodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CrudObserver
{
   use GenerateKodeTrait;

   public function creating(Model $model)
   {
      if(isset($model->autonumberPrefix)) {

         $variabel_field_kode = Variabel::query()->firstWhere('nama', 'field_kode');
         $variabel_field_tanggal = Variabel::query()->firstWhere('nama', 'field_tanggal');
         $variabel_kode_prefix = Variabel::query()->firstWhere('nama', $model->autonumberPrefix);
         $variabel_kode_format = Variabel::query()->firstWhere('nama', $model->autonumberFormat);

         $tanggal = $model->getAttribute($variabel_field_tanggal->nilai);

         $kode = $this->generateKodeTransaksi($model->getTable(), $variabel_kode_prefix->nilai, $variabel_kode_format->nilai, $tanggal);
         $model->setAttribute($variabel_field_kode->nilai, $kode);

         Log::info($kode);
      }

      // Log::info($model->getTable());
      // Log::info($model->autonumberPrefix);
   }
}
