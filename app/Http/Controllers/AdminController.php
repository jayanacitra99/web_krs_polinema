<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\MatkulModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use App\Imports\DatasetImport;
use Excel;
use App\Models\DatasetModel;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function list_jurusan()
    {
        $data = JurusanModel::paginate(5);
        return view('admin.list_jurusan', compact('data'));
    }

    public function add_jurusan(Request $request)
    {
        $request->validate(['jurusan' => 'required']);
      
        JurusanModel::create([
            'nama_jurusan' => $request->jurusan,
        ]);
        $toastr = array(
            'message' => 'Data jurusan berhasil di tambahkan !',
            'alert' => 'success'
        );
        return redirect()->route('jurusan')->with($toastr);
    }

    public function edit_jurusan(Request $request, $id)
    {
        $request->validate(['jurusan' => 'required']);
        JurusanModel::find($id)->update(['nama_jurusan' => $request->jurusan]);
        $toastr = array(
            'message' => 'Data jurusan berhasil di perbarui !',
            'alert' => 'success'
        );
        return redirect()->route('jurusan')->with($toastr);
    }

    public function delet_jurusan($id)
    {
        //fungsi eloquent untuk menghapus data
        JurusanModel::find($id)->delete();
        return redirect()->route('absensi')->with('success', 'Data Berhasil Dihapus');
    }

    public function list_prodi()
    {
        $data = ProdiModel::join('list_jurusan', 'list_prodi.jurusan_id', '=', 'list_jurusan.id_lj')->paginate(5);
        $jurusan = JurusanModel::all();
        return view('admin.list_prodi', compact('data', 'jurusan'));
    }

    public function add_prodi(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'prodi' => 'required',
            'tingkat' => 'required',
        ]);
        ProdiModel::create([
            'jurusan_id' => $request->jurusan_id,
            'prodi' => $request->prodi,
            'tingkat' => $request->tingkat,
        ]);
        // Session::flash('success', 'Data prodi berhasil di tambahkan');
        return redirect()->route('prodi')->with('success', 'Data Prodi Berhasil di tambahkan !');
    }

    public function edit_prodi(Request $request, $id)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'prodi' => 'required',
            'tingkat' => 'required',
        ]);
        ProdiModel::find($id)->update([
            'jurusan_id' => $request->jurusan_id,
            'prodi' => $request->prodi,
            'tingkat' => $request->tingkat,
        ]);
        // Session::flash('success', 'Data prodi berhasil di perbarui');
        return redirect()->route('prodi')->with('success', 'Data prodi berhasil di perbarui !');
    }

    public function delet_prodi($id)
    {
        //fungsi eloquent untuk menghapus data
        ProdiModel::find($id)->delete();
        return redirect()->route('prodi')->with('success', 'Data Berhasil Dihapus');
    }

    public function list_matkul()
    {
        $data = MatkulModel::join('list_prodi', 'list_matkul.id_prodi', '=', 'list_prodi.id_prodi')->join('list_jurusan', 'list_prodi.jurusan_id', '=', 'list_jurusan.id_lj')->paginate(5);
        $prodi = ProdiModel::join('list_jurusan', 'list_prodi.jurusan_id', '=', 'list_jurusan.id_lj')->get();
        return view('admin.list_matkul', compact('data', 'prodi'));
    }

    public function add_matkul(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required',
            'matkul' => 'required',
            'sks' => 'required',
            'kuota' => 'required',
            'tahun_awal' => 'required',
            'tahun_akhir' => 'required',
        ]);
        MatkulModel::create([
            'id_prodi' => $request->prodi_id,
            'matkul' => $request->matkul,
            'sks' => $request->sks,
            'kuota' => $request->kuota,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
        ]);
        // Session::flash('success', 'Data matkul berhasil di tambahkan');
        return redirect()->route('matkul')->with('success', 'Data Matakuliah Berhasil Di tambahkan !');
    }

    public function edit_matkul(Request $request, $id)
    {
        $request->validate([
            'prodi_id' => 'required',
            'matkul' => 'required',
            'sks' => 'required',
            'kuota' => 'required',
            'tahun_awal' => 'required',
            'tahun_akhir' => 'required',
        ]);
        MatkulModel::find($id)->update([
            'id_prodi' => $request->prodi_id,
            'matkul' => $request->matkul,
            'sks' => $request->sks,
            'kuota' => $request->kuota,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
        ]);
        // Session::flash('success', 'Data matkul berhasil di perbarui');
        return redirect()->route('matkul')->with('success', 'Data Matakuliah Berhasil Di perbarui');
    }

    public function delet_matkul($id)
    {
        //fungsi eloquent untuk menghapus data
        MatkulModel::find($id)->delete();
        return redirect()->route('matkul')->with('success', 'Data Berhasil Dihapus');
    }

    public function importDataset(Request $request){
        if(DatasetModel::exists()){
            DatasetModel::truncate();
            Excel::import(new DatasetImport,Request()->file);
        } else {
            Excel::import(new DatasetImport,Request()->file);
        }
        $toastr = array(
            'message' => 'Upload Success!',
            'alert' => 'success'
        );
        return redirect()->back()->with($toastr);
    }
}
