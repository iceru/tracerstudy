<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alumni;
use App\Jabatan;
use App\Perusahaan;

class HistoryPekerjaan extends Model
{
    protected $guarded = [];
    protected $table = 'history_pekerjaan';
    public $incrementing = false;

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class);
    }

    public function alumni()
    {
        return $this->hasMany(Alumni::class);
    }

    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class);
    }

}
