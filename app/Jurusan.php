<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    public $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $guarded = [];
}
