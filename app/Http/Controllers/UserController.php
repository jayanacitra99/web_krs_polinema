<?php

namespace App\Http\Controllers;

use App\Models\MatkulModel;
use App\Models\ProdiModel;
use App\Models\KrsModel;
use App\Models\DatasetModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function krs(){
        $krs = KrsModel::all();
        $data = MatkulModel::orderBy('cluster','DESC')->join('list_prodi', 'list_matkul.id_prodi', '=', 'list_prodi.id_prodi')->join('list_jurusan', 'list_prodi.jurusan_id', '=', 'list_jurusan.id_lj')->join('dataset','dataset.id_mk','=','list_matkul.id_mk')->get();
        $prodi = ProdiModel::join('list_jurusan', 'list_prodi.jurusan_id', '=', 'list_jurusan.id_lj')->get();
        $dataset = DatasetModel::join('list_jurusan','dataset.jurusanTujuan','=','list_jurusan.id_lj')->join('list_matkul','dataset.id_mk','=','list_matkul.id_mk')->join('list_prodi','list_matkul.id_prodi','=','list_prodi.id_prodi')->orderBy('cluster','desc')->get();
        $jurusan = JurusanModel::get();
        $matkul = MatkulModel::join('list_prodi', 'list_matkul.id_prodi', '=', 'list_prodi.id_prodi')->get();
        return view('krs', compact('data', 'prodi', 'dataset', 'krs', 'jurusan','matkul'));
    }

    public function submitKrs(Request $request){
        $request->validate(
            ['mk' => 'required',]
        );
        KrsModel::create([
            'id_user' => Auth::user()->id,
            'matkul' => serialize($request->mk),
            'status' => 'WAITING',
        ]);
        $toastr = array(
            'message' => 'KRS Success!',
            'alert' => 'success'
        );
        return redirect()->back()->with($toastr);
    }
}
