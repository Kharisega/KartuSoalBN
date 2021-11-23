<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $guarded = [];
}
