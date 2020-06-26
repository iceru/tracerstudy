<?php

namespace App;

use App\PertanyaanDirect;
use Illuminate\Database\Eloquent\Model;

class JawabanDirect extends Model
{
    protected $guarded = [];
    protected $table = 'jawaban_direct_answer';

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }

    public function pertanyaanDirect() {
        return $this->belongsTo(PertanyaanDirect::class, 'id_pertanyaan_da');
    }

}
