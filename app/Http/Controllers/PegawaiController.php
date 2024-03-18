<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function GetAllPegawai()
    {
        $data_pegawai = Pegawai::all();
        return view('admin.pegawai', [
            'title' => 'Data Pegawai',
            'data_pegawai' => $data_pegawai
        ]);
    }

    // add pegawai with admin
    public function AddDataPegawai(Request $request)
    {
        Validator::make($request->all(), [
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
        ]);
        try {
            $data_pegawai = new Pegawai([
                'nama_pegawai' => $request->nama_pegawai,
                'jabatan' => $request->jabatan,
            ]);
            $data_pegawai->save();
            return redirect('/pegawai')->with('success', 'berhasil tersimpan');
        } catch (\Exception $e) {
            return redirect('/form-pegawai')->with('errors', 'gagal tersimpan' . $e);
        }
    }


    // function update datta  pegawai with user admin
    public function UpdateDataPegawai(Request $request)
    {
        Validator::make($request->all(), [
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
        ]);
        try {
            $data_pegawai = array(
                'nama_pegawai' => $request->nama_pegawai,
                'jabatan' => $request->jabatan,
            );
            Pegawai::where('pegawai_id', $request->pegawai_id)->update($data_pegawai);
            return redirect('/pegawai')->with('success', 'Data pegawai berhasil update');
        } catch (\Exception $e) {
            return redirect('/pegawai')->with('errors', 'Data pegawai gagal update' . $e);
        }
    }


    // delete pegawai with user  admin
    public function DeleteDataPegawai($id)
    {
        try {
            Pegawai::where('pegawai_id', $id)->delete();
            return redirect('/pegawai')->with('success', 'Data pegawai berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/pegawai')->with('errors', 'Data pegawai gagal dihapus' . $e);
        }
    }
}