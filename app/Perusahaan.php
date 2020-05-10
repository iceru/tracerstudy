<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sektor;

class Perusahaan extends Model
{
    protected $guarded = [];
    protected $table = 'perusahaan';
    public $incrementing = false;

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'id_sektor');
    }

    public function historyPekerjaan()
    {
        return $this->belongsTo(HistoryPekerjaan::class);
    }
}
