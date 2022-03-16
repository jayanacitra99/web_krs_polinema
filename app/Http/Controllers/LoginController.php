<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
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
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

        $cek = User::where('username', $username)->first();

        if (!$cek) {
            $user = new User;
            $user->username = $username;
            $user->password = Hash::make($password);;
            $user->role = 3;
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
}
