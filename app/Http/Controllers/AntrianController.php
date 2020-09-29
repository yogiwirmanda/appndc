<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use App\Antrian;

class AntrianController extends Controller
{
    public function index()
    {
      $title = "Konfirmasi Pendaftaran";
      $idPasien = Session::get('idPasien');
      $antrians = DB::table('antrians')
               ->where([
                  ['id_pasien', '=', $idPasien],
               ])
               ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
               ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
               ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
               ->join('polis', 'dokters.poli', '=', 'polis.id')
               ->select('antrians.*', 'pasiens.nama_pasien','pasiens.alamat','pasiens.no_rm',
                        'jadwals.hari','dokters.nama_dokter','polis.name AS nama_poli')
               ->orderBy('antrians.created_at','desc')
               ->first();
      return view('front.pasien.antrian', compact('title','antrians'));
    }

     public function store(Request $request)
    {
      $request->validate([
        'id_pasien'=>'required',
        'id_jadwal'=>'required',
        'tanggal'=>'required',
      ]);

      if ($request->get('aksiFrom') == "frontend"){
        $antrian = new Antrian([
          'id_pasien' => $request->get('id_pasien'),
          'id_jadwal' => $request->get('id_jadwal'),
          'tanggal' => $request->get('tanggal'),
        ]);

        $antrian->save();
        return redirect('/fantrians')->with('success','Berhasil Daftar');
      }else{
        $noAntrian = self::getAntrian($request->get('id_jadwal'),$request->get('tanggal'));
        $antrian = new Antrian([
          'id_pasien' => $request->get('id_pasien'),
          'id_jadwal' => $request->get('id_jadwal'),
          'tanggal' => $request->get('tanggal'),
          'no_antrian' => $noAntrian,
          'status' => '1',
        ]);
        $antrian->save();
        return redirect('/lpendaftarans')->with('success','Berhasil Daftar');
      }

    }

    public function confirm($idAntrian = '',$idPasien = '')
    {
      $title = "Pendaftaran Selesai";
      $antrians = DB::table('antrians')
               ->where([
                  ['id_pasien', '=', $idPasien],
               ])
               ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
               ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
               ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
               ->join('polis', 'dokters.poli', '=', 'polis.id')
               ->select('antrians.*', 'pasiens.nama_pasien','pasiens.alamat','pasiens.no_rm',
                        'jadwals.hari','dokters.nama_dokter','polis.name AS nama_poli')
               ->orderBy('antrians.created_at','desc')
               ->first();
      $antrian = Antrian::find($idAntrian);
      $noAntrian = self::getAntrian($antrian->id_jadwal,$antrian->tanggal);
      $antrian->status = '1';
      $antrian->no_antrian = $noAntrian;
      $antrian->save();
      return view('front.pasien.antrianComplete',compact('antrians','noAntrian','title'));
    }

    public function getAntrian($idJadwal='', $tanggal = '')
    {
      $antrian = DB::table('antrians')
               ->where([
                  ['id_jadwal', '=', $idJadwal],
                  ['tanggal' , '=', $tanggal],
                  ['status' , '=', '1'],
               ])
               ->select('antrians.*')
               ->orderBy('antrians.id','desc')
               ->get();
      $countAntrian = count($antrian);
      $noAntrian = $countAntrian + 1;
      return $noAntrian;
    }

    public function pdf($noAntrian,$jamdari,$hari,$dokter,$pasien,$alamat)
    {
        $noAntrian = trim($noAntrian);
        $jamdari = trim($jamdari);
        $hari = trim($hari);
        $dokter = trim($dokter);
        $pasien = trim($pasien);
        $alamat = trim($alamat);
      $title = "Pendaftaran Selesai";
      $pdf = PDF::loadView('front.pasien.antrianPdf',compact('jamdari','noAntrian','title','hari','dokter','pasien','alamat'));
      return $pdf->download('print.pdf');
    }
}
