<?php

namespace App;

use App\Prodi;
use App\Alumni;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = [];
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    public $incrementing = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }

    public function scopeFilter($mhs)
    {
        if(request('prodi')) {
            $mhs->whereHas('prodi', function($prd) {
                $prd->where('nama_prodi', '=', request('prodi'));
            });
        }

        if(request('fakultas')) {
            $mhs->whereHas('prodi', function($prd) {
                $prd->whereHas('fakultas', function($fkl) {
                    $fkl->where('nama_fakultas', '=', request('fakultas'));
                });
            });
        }

        if(request('lulusan')) {
            $mhs->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'));
        }

        return $mhs;
    }
}
