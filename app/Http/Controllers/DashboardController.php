<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function GetDataDashboard()
    {
        $sumbuYVertikal = Tamu::selectRaw('count(*) data')
            ->groupBy(DB::raw("monthname(request_tanggal)"))->pluck('data');
        $sumbuXHorizontal = Tamu::select(DB::raw("MONTHNAME(request_tanggal) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(request_tanggal)"))
            ->pluck('bulan');
        return view('admin.dashboard', [
            'sumbuYVertikal' => $sumbuYVertikal,
            'sumbuXHorizontal' => $sumbuXHorizontal,
        ]);
    }
}
