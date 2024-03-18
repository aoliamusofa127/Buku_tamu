<?php

namespace App\Http\Controllers;

use App\Models\TentangDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TentangDinasController extends Controller
{
    public function GetAllTentangDinas()
    {
        $tentang_dinas = TentangDinas::all();
        $count_data = TentangDinas::all()->count();
        return view('admin.tentang_dinas', [
            'title' => 'Tentang Dinas',
            'dinas' => $tentang_dinas,
            'count_data' => $count_data
        ]);
    }
    public function AddTentangDinas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:png,jpg,svg,jpeg|max:2048', // Validasi untuk logo
            'content' => 'required',
            'sub_content' => 'required',
            'kutipan' => 'required',
        ]);
        try {

            if (!$validator->fails()) {
                $getFile = $request->file('logo'); //ambil file yang di upload dari gambar
                $getFileName = $getFile->hashName(); //hash nama file yang di upload
                $direktory = "/logo/$getFileName";
                $request->logo->move(public_path('/logo/'), $getFileName);
            } elseif ($request->fails()) {
                return redirect('/dinas')->with('errors', 'logo tidak boleh kosong');
            }
            $data_dinas = new TentangDinas([
                'logo' => $direktory,
                'content' => $request->content,
                'sub_content' => $request->sub_content,
                "link_youtube" => $request->link_youtube,
                "link_instagram" => $request->link_instagram,
                "link_facebook" => $request->link_facebook,
                'kutipan' => $request->kutipan,
            ]);
            $data_dinas->save();
            return redirect('/dinas')->with('success', 'data berhasil di tambahkan');
        } catch (\Exception $e) {
            return redirect('/dinas')->with('errors', 'data gagal di tambahkan' . $e->getMessage());
        }
    }
    public function UpdateTentangDinas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:png,jpg,svg,jpeg|max:2048', // Validasi untuk logo
            'content' => 'required',
            'sub_content' => 'required',
            'kutipan' => 'required',
        ]);
        // dd($validator);
        try {

            if (!$validator->fails()) {
                $getFile = $request->file('logo'); //ambil file yang di upload dari gambar
                $getFileName = $getFile->hashName(); //hash nama file yang di upload
                $direktory = "/logo/$getFileName";
                $request->logo->move(public_path('/logo/'), $getFileName);
            } elseif ($request->fails()) {
                return redirect('/dinas')->with('errors', 'logo tidak boleh kosong');
            }
            $data_dinas = array(
                'logo' => $direktory,
                'content' => $request->content,
                'sub_content' => $request->sub_content,
                "link_youtube" => $request->link_youtube,
                "link_instagram" => $request->link_instagram,
                "link_facebook" => $request->link_facebook,
                'kutipan' => $request->kutipan,
            );
            // dd($data_dinas);
            TentangDinas::where('dinas_id', $request->dinas_id)->update($data_dinas);
            return redirect('/dinas')->with('success', 'data berhasil di edit');
        } catch (\Exception $e) {
            return redirect('/dinas')->with('errors', 'data gagal di edit' . $e->getMessage());
        }
    }
    public function DeleteTentangDinas($id)
    {
        try {
            TentangDinas::where('dinas_id', $id)->delete();
            return redirect('/dinas')->with('success', 'Data tentang dinas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/dinas')->with('errors', 'Data tentang dinas gagal dihapus' . $e);
        }
    }
}