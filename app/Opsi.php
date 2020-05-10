<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pertanyaan;

class Opsi extends Model
{
    protected $guarded = [];
    protected $table = 'opsi_pertanyaan';
    public $incrementing = false;

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }
}
