<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alumni;

class Jawaban extends Model
{
    protected $guarded = [];
    protected $table = 'jawaban';
    public $incrementing = false;
    public $timestamps = true;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }

    public function pertanyaan() {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    public function opsi() {
        return $this->belongsTo(Opsi::class, 'id_opsi');
    }

    public function scopeFilter($jwb)
    {
        if(request('prodi')) {
                $jwb->whereHas('alumni', function($alm) {
                    $alm->whereHas('mahasiswa', function($mhs) {
                        $mhs->whereHas('prodi', function($prd) {
                            $prd->where('nama_prodi', '=', request('prodi'));
                        });
                    });
                });
        }

        if(request('fakultas')) {
                $jwb->whereHas('alumni', function($alm) {
                    $alm->whereHas('mahasiswa', function($mhs) {
                        $mhs->whereHas('prodi', function($prd) {
                            $prd->whereHas('fakultas', function($fkl) {
                                $fkl->where('nama_fakultas', '=', request('fakultas'));
                            });
                        });
                    });
                });
        }

        if(request('lulusan')) {
                $jwb->whereHas('alumni', function($alm) {
                    $alm->whereHas('mahasiswa', function($mhs) {
                        $mhs->where(DB::raw("YEAR(tgl_yudisium)"), '=', request('lulusan'));
                    });
                });
        }

        return $jwb;
    }
}
