<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $guarded = [];
    protected $table = 'jabatan';
    public $incrementing = false;


    public function historyPekerjaan()
    {
        return $this->belongsTo(HistoryPekerjaan::class, 'id_jabatan');
    }
}
