<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class tamusController extends Controller
{
    public function index()
    {
     $tamus = Tamu::all();
     return view('tamus',['tamus'=>$tamus]);
    }
 
    public function cetak_pdf()
    {
     $tamus = Tamu::all();
 
     $pdf = Pdf::loadview('tamus_pdf',['tamus'=>$tamus]);
     return $pdf->download('laporan-tamus-pdf');
    }
    public function tamus_pdf()
{
 $tamus = Tamu::all();
 
 $pdf = PDF::loadview('tamus_pdf',['tamus'=>$tamus]);
 return $pdf->download('laporan-tamus-pdf');
}
}