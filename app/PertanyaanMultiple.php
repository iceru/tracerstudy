<?php

namespace App;

use App\OpsiMultiple;
use App\JawabanMultiple;
use Illuminate\Database\Eloquent\Model;

class PertanyaanMultiple extends Model
{
    protected $guarded = [];
    protected $table = 'pertanyaan_multiple_answer';
    public $incrementing = false;

    public function opsiMa()
    {
        return $this->hasMany(OpsiMultiple::class, 'id_pertanyaan_ma');
    }


    public function jawaban()
    {
        return $this->hasMany(JawabanMultiple::class, 'id_pertanyaan_ma');
    }

}
