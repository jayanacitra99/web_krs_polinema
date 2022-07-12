<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\JurusanModel;
use App\Models\ProdiModel;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        $data = [
            'jurusan' => JurusanModel::get(),
        ];
        return view('register',$data);
    }

    public function getProdi($jid){
        $prodi = ProdiModel::where('jurusan_id',$jid)->get();
        return response()->json($prodi);
    }

    public function proslog(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            $toastr = array(
                'message' => 'Welcome to KRS Polinema!',
                'alert' => 'success'
            );
            // Session::flash('success', 'Welcome to KRS Polinema!');
            return redirect()->route('home')->with($toastr);
        } else {
            //Login Fail
            $toastr = array(
                'message' => 'Username atau password anda salah!',
                'alert' => 'error'
            );
            return redirect()->route('login')->with($toastr);
        }
    }

    public function prosreg(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'nim' => 'required|unique:users,nim|max:11',
            'name' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

        $cek = User::where('username', $username)->first();

        if (!$cek) {
            $user = new User;
            $user->username = $username;
            $user->password = Hash::make($password);;
            $user->role = 3;
            $user->nama = $request->name;
            $user->nim = $request->nim;
            $user->jurusan = $request->jurusan;
            $user->prodi = $request->prodi;
            $user->save();
            $toastr = array(
                'message' => 'Succes to register !',
                'alert' => 'success'
            );
            // Session::flash('success', 'Welcome to KRS Polinema!');
            return redirect()->route('login')->with($toastr);
        }else{
            $toastr = array(
                'message' => 'Username sudah terdaftar!',
                'alert' => 'error'
            );
            return redirect()->route('register')->with($toastr);
        }

      
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }

    public function profile(){
        $data = [
            'jurusan' => JurusanModel::get()        
        ];
        return view('editProfile',$data);
    }

    public function editProfile($id){
        $cek = User::where('id', $id)->first();
        Request()->validate([
            'username'  => ($cek->username === Request()->username) ? 'required':'required|unique:users,username',
            'name'      => 'required'
        ]);
        $data = [
            'username'  => Request()->username,
            'nama'  => Request()->name,
        ];
        User::where('id',$id)->update($data);

        Request()->session()->flash('success','Profile Edited!!');
        return redirect('profile'); 
    }

    public function changePass($id){
        Request()->validate([
            'password' => 'required|string|min:4|confirmed',
        ]);
        $data = [
            'password' => bcrypt(Request()->password),
        ];
        User::where('id',$id)->update($data);
        Request()->session()->flash('success','Password Changed!!');
        return redirect('profile'); 

    }
}
