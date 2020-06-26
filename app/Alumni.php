<?php

namespace App;

use App\Jawaban;
use App\Mahasiswa;
use App\HistoryPekerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $guarded = [];
    protected $table = 'alumni';
    public $incrementing = false;

    public function historyPekerjaan()
    {
        return $this->belongsTo(HistoryPekerjaan::class, 'id_alumni');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_alumni', 'id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'NIM', 'NIM');
    }

    public function scopeFilter($a)
    {
        if(request('prodi')) {
            $a->whereHas('mahasiswa', function($mhs) {
                $mhs->whereHas('prodi', function($prd) {
                    $prd->where('nama_prodi', '=', request('prodi'));
                });
            });
        }

        if(request('fakultas')) {
            $a->whereHas('mahasiswa', function($mhs) {
                $mhs->whereHas('prodi', function($prd) {
                    $prd->whereHas('fakultas', function($fkl) {
                        $fkl->where('nama_fakultas', '=', request('fakultas'));
                    });
                });
            });
        }

        if(request('lulusan')) {
            $a->whereHas('mahasiswa', function($mhs) {
                $mhs->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'));
            });
        }

        return $a;
    }
}
