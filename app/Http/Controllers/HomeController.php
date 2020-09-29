<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Pasien;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        $title = "Dashboard";
        $getJumlah = DB::table('antrians')
                    ->where('tanggal','=',date('Y-m-d'))
                    ->select(DB::raw('COUNT(id) as jumlahPasien'))
                    ->first();
        $pa_today = $getJumlah->jumlahPasien;
        $getDiperiksa = DB::table('antrians')
                        ->where([
                          ['tanggal','=',date('Y-m-d')],
                          ['status','=','1'],
                          ['status_hadir','=','1'],
                        ])
                        ->select(DB::raw('COUNT(id) as jumlahDiperiksa'))
                        ->first();
        $pa_cek_today = $getDiperiksa->jumlahDiperiksa;
        return view('admin.master.dashboard', compact('pa_today','pa_cek_today','title'));
    }
}
