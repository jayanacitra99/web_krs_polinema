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
        $totalRow = count($rows);
        $a = 1;
        $b = floor($totalRow / 2);
        $c = $totalRow;
        $x = 1;
        foreach ($rows as $tex) {
            if ($x == $a) {
                $ax1 = $tex['x1'];
                $ax2 = $tex['x2'];
                $ax3 = $tex['x3'];
                $pc1 = array($ax1,$ax2,$ax3);
            } 
            if ($x == $b){
                $bx1 = $tex['x1'];
                $bx2 = $tex['x2'];
                $bx3 = $tex['x3'];
                $pc2 = array($bx1,$bx2,$bx3);
            } 
            if ($x == $c){
                $cx1 = $tex['x1'];
                $cx2 = $tex['x2'];
                $cx3 = $tex['x3'];
                $pc3 = array($cx1,$cx2,$cx3);
            }
            $x++;
        }
        foreach ($rows as $row) 
        {
            $tempx1 = sqrt(pow($row['x1']-$ax1,2) + pow($row['x2']-$ax2,2) + pow($row['x3']-$ax3,2));
            $tempx2 = sqrt(pow($row['x1']-$bx1,2) + pow($row['x2']-$bx2,2) + pow($row['x3']-$bx3,2));
            $tempx3 = sqrt(pow($row['x1']-$cx1,2) + pow($row['x2']-$cx2,2) + pow($row['x3']-$cx3,2));
            if (($tempx1 <= $tempx2) && ($tempx1 <= $tempx3)) {
                $cluster = 1;
            } 
            elseif (($tempx2 <= $tempx1) && ($tempx2 <= $tempx3)) {
                $cluster = 2;
            } 
            elseif (($tempx3 <= $tempx1) && ($tempx3 <= $tempx2)) {
                $cluster = 3;
            }
            
            $dataset = [
                'id_mk'         => $row['mk'],
                'jurusanAsal'   => request('asal'),
                'jurusanTujuan' => request('tujuan'),
                'x1'            => $row['x1'],
                'x2'            => $row['x2'],
                'x3'            => $row['x3'],
                'tempx1'        => $tempx1,
                'tempx2'        => $tempx2,
                'tempx3'        => $tempx3,
                'pusatC1'       => implode(" ",$pc1),
                'pusatC2'       => implode(" ",$pc2),
                'pusatC3'       => implode(" ",$pc3),
                'cluster'       => $cluster,
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
