<?php

namespace App\Http\Controllers;

use App\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranController extends Controller
{

    public function index($date=null)
    {
        $title = 'Pasien Hari Ini';
        $today = date('Y-m-d');
        if ($date != null){
            $today = $date;
        }
        $dataAntrian = DB::table('antrians')
                    ->join('pasiens','antrians.id_pasien','=','pasiens.id')
                    ->join('jadwals','antrians.id_jadwal','=','jadwals.id')
                    ->join('dokters','jadwals.id_dokter','=','dokters.id')
                    ->join('polis','dokters.poli','=','polis.id')
                    ->select('antrians.id As antrianId','antrians.status_hadir','pasiens.*','dokters.nama_dokter','polis.name As nama_poli')
                    ->where('tanggal','=',$today)
                    ->get();
        return view('admin.kehadiran.index', compact('title','dataAntrian'));
    }


    public function edit($id)
    {
        $antrian = Antrian::find($id);
        $statusBefore = $antrian->status_hadir;
        if ($statusBefore == 0){
            $antrian->status_hadir = 1;
        }else{
            $antrian->status_hadir = 0;
        }
        $antrian->save();
        return redirect('/kehadirans/');
    }

}
