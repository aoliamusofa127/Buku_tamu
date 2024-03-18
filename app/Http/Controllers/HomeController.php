<?php

namespace App\Http\Controllers;

use App\Models\DataMaster;
use App\Models\TentangDinas;

class HomeController extends Controller
{
    public function ViewIndexLandingpage()
    {
        $data = DataMaster::latest()->paginate('1');
        $dataindustri = TentangDinas::all();
        return view('landingpage.index', compact('data', 'dataindustri'), ['title' => 'Buku Tamu']);
    }
}
