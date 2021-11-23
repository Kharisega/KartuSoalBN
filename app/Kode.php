<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kode extends Model
{
    public $table = 'kompetensi_dasar';
    protected $primaryKey = 'id_kd';
    protected $guarded = [];
}
