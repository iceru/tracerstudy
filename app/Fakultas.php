<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Prodi;

class Fakultas extends Model
{
    protected $guarded = [];
    protected $table = 'fakultas';
    public $incrementing = false;

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }
}

