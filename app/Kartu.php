<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kartu extends Model
{
    public $table = 'kartu_soal';
    protected $primaryKey = 'id_kartu';
    protected $guarded = [];
}
