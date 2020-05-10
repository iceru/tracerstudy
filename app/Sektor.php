<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perusahaan;

class Sektor extends Model
{
    protected $guarded = [];
    protected $table = 'sektor_perusahaan';
    public $incrementing = false;

    public function perusahaan()
    {
        return $this->hasMany(Perusahaan::class);
    }
}
