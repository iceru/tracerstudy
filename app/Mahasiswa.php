<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Prodi;
use App\Alumni;

class Mahasiswa extends Model
{
    protected $guarded = [];
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    public $incrementing = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }
}
