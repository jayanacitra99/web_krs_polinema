<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\MatkulModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use App\Imports\DatasetImport;
use Excel;
use App\Models\DatasetModel;
use App\Models\KrsModel;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'jurusan' => JurusanModel::get(),
        ];
        return view('admin.dashboard',$data);
    }

    public function list_jurusan()
    {
        $data = JurusanModel::paginate(5);
        return view('admin.list_jurusan', compact('data'));
    }

    public function add_jurusan(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
            
        ]);
      
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
        $toastr = array(
            'message' => 'Delete Success!',
            'alert' => 'success'
        );
        return redirect('jurusan')->with($toastr);
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
        ]);
        ProdiModel::create([
            'jurusan_id' => $request->jurusan_id,
            'prodi' => $request->prodi,
        ]);
        // Session::flash('success', 'Data prodi berhasil di tambahkan');
        return redirect()->route('prodi')->with('success', 'Data Prodi Berhasil di tambahkan !');
    }

    public function edit_prodi(Request $request, $id)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'prodi' => 'required',
        ]);
        ProdiModel::find($id)->update([
            'jurusan_id' => $request->jurusan_id,
            'prodi' => $request->prodi,
        ]);
        // Session::flash('success', 'Data prodi berhasil di perbarui');
        return redirect()->route('prodi')->with('success', 'Data prodi berhasil di perbarui !');
    }

    public function delet_prodi($id)
    {
        //fungsi eloquent untuk menghapus data
        ProdiModel::find($id)->delete();
        $toastr = array(
            'message' => 'Delete Success!',
            'alert' => 'success'
        );
        return redirect('prodi')->with($toastr);
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
            'id_mk' => 'required|unique:list_matkul,id_mk',
        ]);
        MatkulModel::create([
            'id_mk' => $request->id_mk,
            'id_prodi' => $request->prodi_id,
            'matkul' => $request->matkul,
            'sks' => $request->sks,
            'kuota' => $request->kuota,
        ]);
        // Session::flash('success', 'Data matkul berhasil di tambahkan');
        return redirect()->route('matkul')->with('success', 'Data Matakuliah Berhasil Di tambahkan !');
    }

    public function edit_matkul(Request $request, $id)
    {
        $cek = MatkulModel::where('id_mk', $id)->first();
        $request->validate([
            'prodi_id' => 'required',
            'matkul' => 'required',
            'sks' => 'required',
            'kuota' => 'required',
            'id_mk' => ($cek->id_mk === Request()->id_mk) ? 'required':'required|unique:list_matkul,id_mk',
        ]);
        MatkulModel::find($id)->update([
            'id_prodi' => $request->prodi_id,
            'matkul' => $request->matkul,
            'sks' => $request->sks,
            'kuota' => $request->kuota,
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
        Request()->validate([
            'asal' => 'required',
            'tujuan'=> 'required    ',
            'file'  => 'required'
        ]);
        Excel::import(
            new DatasetImport(Request()->asal,Request()->tujuan),
            Request()->file
        );
        $toastr = array(
            'message' => 'Dataset Uploaded!',
            'alert' => 'success'
        );
        return redirect()->back()->with($toastr);
    }

    public function listKRS(){
        $data = [
            'krs' => KrsModel::join('users','users.id','=','krs.id_user')->get(),
            'matkul' => MatkulModel::get(),
            'jurusan' => JurusanModel::get()
        ];
        return view('admin/krsStatus',$data);
    }
    public function actionKRS($id,$status){
        $data = [
            'status' => $status,
        ];
        KrsModel::where('id_krs',$id)->update($data);
        // KrsModel::find($id)->update([
        //     'status' => 'APPROVED'
        // ]);
        $toastr = array(
            'message' => 'Success!',
            'alert' => 'success'
        );
        return redirect()->back()->with($toastr);
    }
}
