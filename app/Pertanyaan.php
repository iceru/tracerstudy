<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Opsi;
use App\Jawaban;
use App\survey;

class Pertanyaan extends Model
{
    protected $guarded = [];
    protected $table = 'pertanyaan';
    public $incrementing = false;

    public function survey() {
        return $this->belongsTo(Survey::class);
    }

    public function opsi()
    {
        return $this->hasMany(Opsi::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan');
    }
}
