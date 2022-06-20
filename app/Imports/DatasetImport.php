<?php

namespace App\Imports;

use App\Models\DatasetModel;
use App\Models\MatkulModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

use function PHPSTORM_META\map;

class DatasetImport implements ToCollection,WithHeadingRow,WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $dataset = [
                'id_mk'         => $row['mk'],
                'jurusanAsal'   => request('asal'),
                'jurusanTujuan' => request('tujuan'),
                'x1'            => $row['x1'],
                'x2'            => $row['x2'],
                'x3'            => $row['x3'],
                'total'         => $row['total'],
                'cluster'       => $row['cluster'],
            ];
            $check = DatasetModel::get();
            $matkul = MatkulModel::join('list_prodi','list_matkul.id_prodi','=','list_prodi.id_prodi')->get();
            $found = false;
            foreach ($matkul as $mk) {
                if ($mk->id_mk == $row['mk']) {
                    if ($mk->jurusan_id == request('tujuan')) {
                        foreach ($check as $find) {
                            if (($find->id_mk == $row['mk']) && ($find->jurusanAsal == request('asal')) && ($find->jurusanTujuan == request('tujuan'))) {
                                $found = true;
                                DatasetModel::where('id',$find->id)->update($dataset);
                            }
                        }
                        if (!$found) {
                            DatasetModel::create($dataset);
                        }
                    }
                }
            }
            
        }
    }
}
