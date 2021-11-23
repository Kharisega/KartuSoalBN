<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    public $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $guarded = [];
}
