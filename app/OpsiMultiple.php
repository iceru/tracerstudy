<?php

namespace App;

use App\JawabanMultiple;
use App\PertanyaanMultiple;
use Illuminate\Database\Eloquent\Model;

class OpsiMultiple extends Model
{
    protected $guarded = [];
    protected $table = 'opsi_pertanyaan_ma';
    public $incrementing = false;

    public function pertanyaanMa()
    {
        return $this->belongsTo(PertanyaanMultiple::class, 'id_pertanyaan_ma');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanMultiple::class, 'id_opsi_ma');
    }

}
