<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HistoryPekerjaan;

class Alumni extends Model
{
    protected $guarded = [];
    protected $table = 'alumni';
    public $incrementing = false;

    public function historyPekerjaan()
    {
        return $this->belongsTo(HistoryPekerjaan::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}
