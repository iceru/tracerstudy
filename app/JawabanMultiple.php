<?php

namespace App;

use App\PertanyaanMultiple;
use Illuminate\Database\Eloquent\Model;

class JawabanMultiple extends Model
{
    protected $guarded = [];
    protected $table = 'jawaban_multiple_answer';
    public $incrementing = false;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }

    public function pertanyaanMultiple() {
        return $this->belongsTo(PertanyaanMultiple::class, 'id_pertanyaan_ma');
    }

    public function opsiMultiple() {
        return $this->belongsTo(OpsiMultiple::class, 'id_opsi_ma');
    }
}
