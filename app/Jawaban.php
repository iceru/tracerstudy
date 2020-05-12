<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alumni;

class Jawaban extends Model
{
    protected $guarded = [];
    protected $table = 'jawaban';
    public $incrementing = false;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }

    public function pertanyaan() {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    public function opsi() {
        return $this->belongsTo(Opsi::class, 'id_opsi');
    }
}
