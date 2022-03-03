<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
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
}
