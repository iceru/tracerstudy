<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fakultas;
use App\Mahasiswa;

class Prodi extends Model
{
    protected $guarded = [];
    protected $table = 'program_studi';
    public $incrementing = false;

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
