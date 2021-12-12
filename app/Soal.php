<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    public $table = 'soal';
    protected $primaryKey = 'id_soal';
    protected $fillable = [
        'no_soal',
        'soalpil',
        'soalessay',
        'gambar',
        'pilgan_a',
        'pilgan_b',
        'pilgan_c',
        'pilgan_d',
        'pilgan_e',
        'kunci_soal',
        '_token',
    ];
}
