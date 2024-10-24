<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Tamu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TamuController extends Controller
{
    // function get view form tamu in landingpage
    public function GetViewFormTamu()
    {
        $data_pegawai  = Pegawai::all();
        return view('landingpage.form_tamu', [
            'title' => 'Form Input Tamu',
            'data_pegawai' => $data_pegawai
        ]);
    }


    // add tamu with tamu
    public function AddTamu(Request $request)
    {
        Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_atau_instansi' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'keperluan' => 'required',
        ]);
        try {
            if ($request->request_tanggal != NULL) {
                $data_tamu = new Tamu([
                    'pegawai_id' => $request->pegawai_id,
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat_atau_instansi' => $request->alamat_atau_instansi,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'keperluan' => $request->keperluan,
                    'request_tanggal' => $request->request_tanggal,
                ]);
                // dd($data_tamu);
                $data_tamu->save();
                return redirect('/form-tamu')->with('success', 'berhasil tersimpan');
            } elseif ($request->request_tanggal == NULL) {
                $data_tamu = new Tamu([
                    'pegawai_id' => $request->pegawai_id,
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat_atau_instansi' => $request->alamat_atau_instansi,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'keperluan' => $request->keperluan,
                    'request_tanggal' => Carbon::now()->format('Y-m-d'),
                ]);
                // dd($data_tamu);
                $data_tamu->save();
                return redirect('/form-tamu')->with('success', 'berhasil tersimpan');
            }
        } catch (\Exception $e) {
            return redirect('/form-tamu')->with('errors', 'gagal tersimpan' . $e);
        }
    }


    // get all tamu in view admin after login
    public function GetAllTamu()
    {
        $data_pegawai  = Pegawai::all();
        $data_tamu = Tamu::with('JoinToPegawai')->orderBy('tamu_id', 'DESC')->get();
        // dd($data_tamu);
        return view('admin.tamu', [
            'title' => 'Data Tamu',
            'data' => $data_tamu,
            'data_pegawai' => $data_pegawai,
        ]);
    }


    // function add tamu in admin
    public function AddTamuWithAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_atau_instansi' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'tempat_pertemuan' => 'required',
            'keperluan' => 'required',
            // 'request_tanggal' => 'required',
        ]);
        try {
            if ($request->request_tanggal != NULL) {
                $data_tamu = new Tamu([
                    'pegawai_id' => $request->pegawai_id,
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat_atau_instansi' => $request->alamat_atau_instansi,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'tempat_pertemuan' => $request->tempat_pertemuan,
                    'keperluan' => $request->keperluan,
                    'request_tanggal' => $request->request_tanggal,
                ]);
                $data_tamu->save();
                return redirect('/tamu')->with('success', 'Data tamu berhasil ditambahkan');
            } elseif ($request->request_tanggal == NULL) {
                $data_tamu = new Tamu([
                    'pegawai_id' => $request->pegawai_id,
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat_atau_instansi' => $request->alamat_atau_instansi,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'tempat_pertemuan' => $request->tempat_pertemuan,
                    'keperluan' => $request->keperluan,
                    'request_tanggal' => Carbon::now()->format('Y-m-d'),
                ]);
                $data_tamu->save();
                return redirect('/tamu')->with('success', 'Data tamu berhasil ditambahkan');
            }
        } catch (\Exception $e) {
            return redirect('/tamu')->with('errors', 'Data tamu gagal ditambahkan' . $e);
        }
    }


    // function update datta  tamu with user admin
    public function UpdateDataTamu(Request $request)
    {
        Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'tempat_pertemuan' => 'required',
            'ststus_tamu' => 'required',
        ]);
        try {
            $data_tamu = array(
                'pegawai_id' => $request->pegawai_id,
                'tempat_pertemuan' => $request->tempat_pertemuan,
                'status_tamu' => $request->status_tamu,
            );
            Tamu::where('tamu_id', $request->tamu_id)->update($data_tamu);
            return redirect('/tamu')->with('success', 'Data tamu berhasil di verifikasi');
        } catch (\Exception $e) {
            return redirect('/tamu')->with('errors', 'Data tamu gagal update' . $e);
        }
    }


    // delete tamu with user  admin
    public function DeleteTamu($id)
    {
        try {
            Tamu::where('tamu_id', $id)->delete();
            return redirect('/tamu')->with('success', 'Data tamu berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/tamu')->with('errors', 'Data tamu gagal dihapus' . $e);
        }
    }
}