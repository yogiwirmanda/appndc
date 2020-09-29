<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Antrian;

class LaporanPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($month = '', $year = '')
    {
        if (strlen($month) == 0 && strlen($year) == 0) {
            $month = date('m');
            $year = date('Y');
        }
        $title = "Laporan Pendaftaran";
        $laporans = DB::table('antrians')
            ->where([
                ['status', '=', '1'],
            ])
            ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->join('polis', 'dokters.poli', '=', 'polis.id')
            ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
            ->select('antrians.*', 'dokters.nama_dokter', 'pasiens.nama_pasien', 'polis.name AS nama_poli')
            ->orderBy('dokters.id','desc')
            ->orderBy('antrians.tanggal','asc')
            ->orderBy('antrians.id_jadwal','asc')
            ->get();
        return view('admin.laporan.pendaftaran', compact('title', 'laporans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function laporanHarian($date = '')
    {
        $title = "Laporan Pendaftaran";
        $laporans = DB::table('antrians')
            ->where([
                ['status', '=', '1'],
                ['tanggal', '=', $date],
            ])
            ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
            ->select('antrians.*', 'dokters.nama_dokter', 'pasiens.nama_pasien')
            ->get();
        return view('admin.laporan.pendaftaranHarian', compact('title', 'laporans'));
    }
}
