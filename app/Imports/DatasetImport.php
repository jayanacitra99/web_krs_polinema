<?php

namespace App\Imports;

use App\Models\DatasetModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class DatasetImport implements ToModel,WithHeadingRow,WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DatasetModel([
            'id_mk'     => $row['mk'],
            'x1'        => $row['x1'],
            'x2'        => $row['x2'],
            'x3'        => $row['x3'],
            'total'     => $row['total'],
            'cluster'   => $row['cluster'],
        ]);
    }
}
