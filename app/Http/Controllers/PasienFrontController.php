<?php

namespace App\Http\Controllers;

use App\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Dokter;
use App\Pasien;
use App\Icd;
use App\Obat;

class PasienFrontController extends Controller
{

    public function dashboard()
    {
        $title = "Dashboard Pasien";
        return view('front.pasien.dashboard', compact('title'));
    }

    public function index()
    {
        if (Session::get('login') == TRUE) {
            $title = "Riwayat Pasien";
            $idPasien = Session::get('idPasien');
            $riwayats = DB::table('antrians')
                ->where([
                    ['id_pasien', '=', $idPasien],
                    ['status', '=', '1'],
                ])
                ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
                ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
                ->join('polis', 'dokters.poli', '=', 'polis.id')
                ->orderBy('antrians.created_at', 'DESC')
                ->first();
            $namaObat='';
            $namaTindakan='';
            $namaDiagnosa='';
            $poli='';
            $dokter='';
            if ($riwayats) {
                $riwayatExplode = explode(",", $riwayats->id_icd);
                $riwayat = $riwayatExplode[0];
                $diagnosa = Icd::find($riwayat);
                $namaDiagnosa = '';
                if ($diagnosa) {
                    $namaDiagnosa = $diagnosa->diagnosa;
                }
                $poli = $riwayats->name;
                $dokter = $riwayats->nama_dokter;
                $namaTindakan = $riwayats->id_tindakan;
                $obatExplode = explode(",", $riwayats->id_obat);
                $obat = $obatExplode[0];
                if (strlen($obat) > 0) {
                    $obatnew = Obat::find($obat);
                    $namaObat = $obatnew->nama_obat;
                } else {
                    $namaObat = "";
                }
            } else {
                $riwayats = NULL;
            }
            $title = "Detail Pasien";
            $pasiens = Pasien::find($idPasien);
            return view('front.pasien.riwayat', compact('title', 'riwayats', 'namaObat', 'namaTindakan', 'namaDiagnosa', 'pasiens','poli','dokter'));
        } else {
            $title = "Pendaftaran Pasien";
            $idPasien = Session::get('idPasien');
            $riwayats = DB::table('antrians')
                ->where([
                    ['id_pasien', '=', $idPasien],
                    ['status', '=', '1'],
                ])
                ->get();
            return view('front.pasien.index', compact('title', 'riwayats'));
        }
    }


    public function create()
    {
        $title = "Pendaftaran Pasien";
        $lastRM = self::getLastRm();
        $newRM = self::generateRm($lastRM);
        return view('front.pasien.create', compact('title', 'newRM'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_rm',
            'nama_pasien',
            'alamat',
            'tempat_lahir',
            'tanggal_lahir',
            'no_telepon',
            'pekerjaan',
            'email_fb',
            'username',
            'password',
        ]);

        $pasien = new Pasien([
            'no_rm' => $request->get('no_rm'),
            'nik' => $request->get('nik'),
            'nama_pasien' => $request->get('nama_pasien'),
            'alamat' => $request->get('alamat'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'no_telepon' => $request->get('no_telepon'),
            'jk' => $request->get('jk'),
            'pekerjaan' => $request->get('pekerjaan'),
            'pembayaran' => $request->get('pembayaran'),
            'no_bpjs' => $request->get('no_bpjs'),
            'email_fb' => $request->get('email_fb'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ]);
        $pasien->save();
        $idPasien = self::autologinPasien($request->username, $request->password);
        Session::put('idPasien', $idPasien);
        Session::put('role', 'pasien');
        Session::put('login', TRUE);
        return redirect('/fpasiens/show')->with('success', 'Pendaftaran Berhasil');
    }

    public function show($id)
    {
        $title = "Pilih Jadwal";
        $dokters = Dokter::all();
        $polis = Poli::all();
        $idPasien = $id;
//        $jadwals = DB::table('jadwals')
//            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
//            ->select('jadwals.*', 'dokters.nama_dokter')
//            ->get();
        return view('front.pasien.jadwal', compact('title', 'polis', 'idPasien'));
    }

    public function loadJadwalDokter()
    {
        $idPoli = $_GET['poli'];
        $jadwals = DB::table('dokters')
            ->where('dokters.poli','=',$idPoli)
            ->select('dokters.*')
            ->get();
        if ($jadwals) {
            $text = "<select name='dokter' id='dokter' class='form-control'>";
            $text .= "<option value='' selected>Pilih Dokter</option>";
            foreach ($jadwals as $data) {
                $text .= "<option value=$data->id>$data->nama_dokter</option>";
            }
            $text .= "</select>";
        } else {
            $text = "NULL";
        }
        return $text;
    }

    public function login()
    {
        $title = "Login Pasien";
        return view('front.pasien.login', compact('title'));
    }

    public function findDayName($day = '')
    {
        $day = strtolower($day);
        if ($day == "monday") {
            $hari = "Senin";
        } else if ($day == "tuesday") {
            $hari = "Selasa";
        } else if ($day == "wednesday") {
            $hari = "Rabu";
        } else if ($day == "thursday") {
            $hari = "Kamis";
        } else if ($day == "friday") {
            $hari = "Jumat";
        } else if ($day == "saturday") {
            $hari = "Sabtu";
        } else if ($day == "sunday") {
            $hari = "Minggu";
        }

        return $hari;
    }

    public function loadJadwal($dokter = '', $tanggal = '')
    {
        $dokter = $_GET['dokter'];
        $tanggal = $_GET['tanggal'];
        $getDay = date('l', strtotime($tanggal));
        $hari = SELF::findDayName($getDay);
        $text='';
        $typeMessage = '';
        $waktu = DB::table('jadwals')
            ->where([
                ['id_dokter', '=', $dokter],
                ['hari', '=', $hari],
            ])
            ->first();
        $idJadwal = '';
        if ($waktu) {
            $idJadwal = $waktu->id;
            $typeMessage = 'success';
            $text = "Jadwal Tersedia";
        } else {
            $typeMessage = 'error';
            $text = "Tidak Ada Jadwal";
        }
        $data=array();
        $data['typeMessage'] = $typeMessage;
        $data['message'] = $text;
        $data['value'] = $idJadwal;
        return json_encode($data);
    }

    public function getLastRm()
    {
        $lastRM = DB::table('pasiens')->orderBy('id', 'desc')->limit(1)->get();
        foreach ($lastRM as $rm) {
            $result = $rm->no_rm;
        }
        if (count($lastRM) == 0){
            $result = '001';
        }
        return $result;
    }

    public function generateRm($lastRM)
    {
        $getLastNumber = substr($lastRM, 2);
        $convertInt = (int)$getLastNumber;
        $resultNumber = $convertInt + 1;
        $newRM = str_pad($resultNumber, 3, "0", STR_PAD_LEFT);
        return $newRM;
    }

    public function getUmur($yearBorn)
    {
        $yearNow = date('Y');
        $umur = $yearNow - $yearBorn;
        return $umur;
    }

    public function loginPasien($username = '', $password = '')
    {
        $cekLogin = DB::table('pasiens')
            ->where([
                ['username', '=', $username],
                ['password', '=', $password],
            ])
            ->select('pasiens.*')
            ->first();
        if ($cekLogin) {
            $idPasien = $cekLogin->id;
            Session::put('idPasien', $idPasien);
            Session::put('role', 'pasien');
            Session::put('login', TRUE);
            return redirect('/fpasiens');
        } else {
            return redirect('/fpasiens');
        }
    }

    public function autologinPasien($username = '', $password = '')
    {
        $cekLogin = DB::table('pasiens')
            ->where([
                ['username', '=', $username],
                ['password', '=', $password],
            ])
            ->select('pasiens.*')
            ->first();
        $idPasien = $cekLogin->id;
        return $idPasien;
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
