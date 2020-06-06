<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pertanyaan;
use App\Jawaban;

class Opsi extends Model
{
    protected $guarded = [];
    protected $table = 'opsi_pertanyaan';
    public $incrementing = false;

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_opsi');
    }
}
