<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kartu extends Model
{
    public $table = 'kartu_soal';
    protected $primaryKey = 'id_kartu';
    protected $fillable = [
        'id_soal',
        'materi',
        'nama_mapel',
        'kelas',
        'jurusan',
        'indikator_soal',
        'jenis_soal',
        'id_kd_peng',
        'id_kd_ket',
        '_token',
    ];
}
