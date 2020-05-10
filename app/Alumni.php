<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HistoryPekerjaan;

class Alumni extends Model
{
    protected $primaryKey = 'id_alumni';
    public $timestamps = false;
    protected $table = 'alumni';

    public function historyPekerjaan()
    {
        return $this->belongsTo(HistoryPekerjaan::class);
    }
}
