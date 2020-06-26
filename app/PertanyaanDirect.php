<?php

namespace App;

use App\JawabanDirect;
use Illuminate\Database\Eloquent\Model;

class PertanyaanDirect extends Model
{
    protected $guarded = [];
    protected $table = 'pertanyaan_direct_answer';
    public $incrementing = false;

    public function jawaban()
    {
        return $this->hasMany(JawabanDirect::class, 'id_pertanyaan_da');
    }

}
