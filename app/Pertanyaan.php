<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Opsi;
use App\Jawaban;

class Pertanyaan extends Model
{
    protected $guarded = [];
    protected $table = 'pertanyaan';
    public $incrementing = false;

    public function opsi()
    {
        return $this->hasMany(Opsi::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}
