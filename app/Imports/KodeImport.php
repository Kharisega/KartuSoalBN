<?php

namespace App\Imports;

use App\Kode;
use Maatwebsite\Excel\Concerns\ToModel;

class KodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kode([
            'kode_kd' => $row[1],
            'ket_kd' => $row[2],
            'nama_mapel' => $row[3],
        ]);
    }
}
