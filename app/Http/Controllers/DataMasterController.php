<?php

namespace App\Http\Controllers;

use App\Models\DataMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DataMasterController extends Controller
{
    public function GetAllDataMaster()
    {
        $data_master = DataMaster::all();
        return view('admin.dataMaster', [
            'title' => 'Qr Code',
            'data_master' => $data_master
        ]);
    }

    // add pegawai with admin
    public function AddDataMaster(Request $request)
    {
        Validator::make($request->all(), [
            'nama_dinas' => 'required',
            'link_barcode' => 'required',
        ]);
        try {
            $data_master = new DataMaster([
                'nama_dinas' => $request->nama_dinas,
                'link_barcode' => $request->link_barcode,
            ]);
            $data_master->save();
            return redirect('/dataMaster')->with('success', 'berhasil tersimpan');
        } catch (\Exception $e) {
            return redirect('/form_dataMaster')->with('errors', 'gagal tersimpan' . $e);
        }
    }


    // function update datta  pegawai with user admin
    public function UpdateDataMaster(Request $request)
    {
        Validator::make($request->all(), [
            'nama_dinas' => 'required',
            'link_barcode' => 'required',
        ]);
        try {
            $data_master = array(
                'nama_dinas' => $request->nama_dinas,
                'link_barcode' => $request->link_barcode,
            );
            DataMaster::where('dataMaster_id', $request->dataMaster_id)->update($data_master);
            return redirect('/dataMaster')->with('success', 'Data master berhasil update');
        } catch (\Exception $e) {
            return redirect('/dataMaster')->with('errors', 'Data master gagal update' . $e);
        }
    }


    // delete pegawai with user  admin
    public function DeleteDataMaster($id)
    {
        try {
            DataMaster::where('dataMaster_id', $id)->delete();
            return redirect('/dataMaster')->with('success', 'Data master berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/dataMaster')->with('errors', 'Data master gagal dihapus' . $e);
        }
    }
}