<?php

namespace App;

use App\Opsi;
use App\survey;
use App\Jawaban;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $guarded = [];
    protected $table = 'pertanyaan';
    public $incrementing = false;

    public function opsi()
    {
        return $this->hasMany(Opsi::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan');
    }

    public function scopeFilter($a)
    {
        if(request('prodi')) {
            $a->whereHas('opsi', function($op) {
                $op->whereHas('jawaban', function($jwb) {
                    $jwb->whereHas('alumni', function($alm) {
                        $alm->whereHas('mahasiswa', function($mhs) {
                            $mhs->whereHas('prodi', function($prd) {
                                $prd->where('nama_prodi', '=', request('prodi'));
                            });
                        });
                    });
                });
            });

        }

        if(request('fakultas')) {
            $a->whereHas('opsi', function($op) {
                $op->whereHas('jawaban', function($jwb) {
                    $jwb->whereHas('alumni', function($alm) {
                        $alm->whereHas('mahasiswa', function($mhs) {
                            $mhs->whereHas('prodi', function($prd) {
                                $prd->whereHas('fakultas', function($fkl) {
                                    $fkl->where('nama_fakultas', '=', request('fakultas'));
                                });
                            });
                        });
                    });
                });
            });
        }

        if(request('lulusan')) {
            $a->whereHas('opsi', function($op) {
                $op->whereHas('jawaban', function($jwb) {
                    $jwb->whereHas('alumni', function($alm) {
                        $alm->whereHas('mahasiswa', function($mhs) {
                            $mhs->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'));
                        });
                    });
                });
            });
        }

        return $a;
    }
}

