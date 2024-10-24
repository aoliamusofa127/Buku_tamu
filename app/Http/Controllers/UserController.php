<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // function get view data all user
    public function GetAllUser()
    {
        $data_user = User::all();
        return view('admin.user', [
            'title' => 'Akun User',
            'data' => $data_user
        ]);
    }

    // post data register
    public function AddAkunUser(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:5',
            'username' => ['required', 'min:5'],
            'email' => ['required', 'min:5', 'unique:users'],
            'password' => 'required|min:6'
        ]);
        try {
            $data = new User([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // dd($data);
            $data->save();
            return redirect('/users')->with('success', 'data berhasil di simpan');
        } catch (\Exception $e) {
            return redirect('/users')->with('errors', 'Akun baru gagal di tambahkan' . $e);
        }
    }

    // post  update data user
    public function UpdateUser(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:5',
            'username' => ['required', 'min:5'],
            'email' => ['required', 'min:5', 'unique:users'],
        ]);
        try {
            $data = array(
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            );
            // dd($data);
            User::where('user_id', $request->user_id)->update($data);
            return redirect('/users')->with('success', 'Akun baru telah ditambahkan');
        } catch (\Exception $e) {
            return redirect('/users')->with('errors', 'Akun baru gagal di tambahkan' . $e);
        }
    }

    // delete tamu with user  admin
    public function DeleteUser($id)
    {
        try {
            User::where('user_id', $id)->delete();
            return redirect('/users')->with('success', 'Data user berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/users')->with('errors', 'Data user gagal dihapus' . $e);
        }
    }

    //Logout User
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/')->with('message', 'User telah logout');
    }
}