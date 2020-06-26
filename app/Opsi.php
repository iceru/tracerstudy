<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pertanyaan;
use App\Jawaban;

class Opsi extends Model
{
    protected $guarded = [];
    protected $table = 'opsi_pertanyaan';
    public $incrementing = false;

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_opsi');
    }

    public function scopeFilter($opsi)
    {
        if(request('prodi')) {
            $opsi->whereHas('jawaban', function($jwb) {
                $jwb->whereHas('alumni', function($alm) {
                    $alm->whereHas('mahasiswa', function($mhs) {
                        $mhs->whereHas('prodi', function($prd) {
                            $prd->where('nama_prodi', '=', request('prodi'));
                        });
                    });
                });
            });
        }

        if(request('fakultas')) {
            $opsi->whereHas('jawaban', function($jwb) {
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
        }

        if(request('lulusan')) {
            $opsi->whereHas('jawaban', function($jwb) {
                $jwb->whereHas('alumni', function($alm) {
                    $alm->whereHas('mahasiswa', function($mhs) {
                        $mhs->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'));
                    });
                });
            });
        }

        return $opsi;
    }
}
