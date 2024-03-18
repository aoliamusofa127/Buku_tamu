<?php

namespace App\Http\Controllers;

use App\Models\DataMaster;
use App\Models\TentangDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    //Logout User
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/')->with('message', 'User telah logout');
    }

    public function login()
    {
        $data_logo = TentangDinas::select('logo')->get();
        $nama_dinas = DataMaster::select('nama_dinas')->get();
        return view('auth.login', [
            'title' => 'Login Admin',
            'data_logo' => $data_logo,
            'nama_dinas'=>$nama_dinas
        ]);
    }

    public function authenticate(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            return redirect('/dashboard')->with('message', 'login berhasil');
        }
        return back()->withErrors(['errors' => 'username atau password tidak valid'])->onlyInput();
    }
}