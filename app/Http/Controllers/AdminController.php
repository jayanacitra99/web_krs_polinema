<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
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
        Session::flash('success', 'Data jurusan berhasil di tambahkan');
        return redirect()->route('jurusan');
    }

    public function edit_jurusan(Request $request, $id)
    {
        $request->validate(['jurusan' => 'required']);
        JurusanModel::find($id)->update(['nama_jurusan' => $request->jurusan]);
        Session::flash('success', 'Data jurusan berhasil di perbarui');
        return redirect()->route('jurusan');
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
        Session::flash('success', 'Data prodi berhasil di tambahkan');
        return redirect()->route('prodi');
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
        Session::flash('success', 'Data prodi berhasil di perbarui');
        return redirect()->route('prodi');
    }

    public function delet_prodi($id)
    {
        //fungsi eloquent untuk menghapus data
        ProdiModel::find($id)->delete();
        return redirect()->route('prodi')->with('success', 'Data Berhasil Dihapus');
    }
}
