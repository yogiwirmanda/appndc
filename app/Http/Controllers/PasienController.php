<?php

namespace App\Http\Controllers;

use App\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pasien;
use App\Dokter;
use App\Icd;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $title = "Data Pasien";
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('title', 'pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Form Tambah Pasien";
        return view('admin.pasien.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_rm' => 'required',
            'nik' => 'required',
            'nama_pasien' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $pasien = new Pasien([
            'no_rm' => $request->get('no_rm'),
            'nik' => $request->get('nik'),
            'nama_pasien' => $request->get('nama_pasien'),
            'alamat' => $request->get('alamat'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'no_telepon' => $request->get('no_telepon'),
            'pekerjaan' => $request->get('pekerjaan'),
            'email_fb' => $request->get('email_fb'),
            'jk' => $request->get('jk'),
            'pembayaran' => $request->get('pembayaran'),
            'no_bpjs' => $request->get('no_bpjs'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ]);

        $pasien->save();

        return redirect('/pasiens')->with('success', 'Data Pasien Berhasil Di Tambahkan');
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
        $title = "Edit Data Pasien";
        $pasiens = Pasien::find($id);
        return view('admin.pasien.edit', compact('title', 'pasiens', 'id'));
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
        $request->validate([
            'no_rm' => 'required',
            'nik' => 'required',
            'nama_pasien' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $pasien = Pasien::find($id);
        $pasien->no_rm = $request->get('no_rm');
        $pasien->nik = $request->get('nik');
        $pasien->alamat = $request->get('alamat');
        $pasien->tempat_lahir = $request->get('tempat_lahir');
        $pasien->tanggal_lahir = $request->get('tanggal_lahir');
        $pasien->no_telepon = $request->get('no_telepon');
        $pasien->pekerjaan = $request->get('pekerjaan');
        $pasien->pembayaran = $request->get('pembayaran');
        $pasien->no_bpjs = $request->get('no_bpjs');
        $pasien->email_fb = $request->get('email_fb');
        $pasien->jk = $request->get('jk');
        $pasien->save();

        return redirect('/pasiens')->with('success', 'Data Pasien Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        return redirect('/pasiens')->with('success', 'Data Pasien Berhasil di Hapus');
    }

    public function kunjunganPasien($id = '')
    {
        $title = "Kunjungan Pasien";
        $dokters = Dokter::all();
        $pasiens = Pasien::find($id);
        $polis = Poli::all();
        $idPasien = $id;
        $jadwals = DB::table('jadwals')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->select('jadwals.*', 'dokters.nama_dokter')
            ->get();
        return view('admin.pasien.kunjungan', compact('title', 'jadwals', 'dokters', 'idPasien','pasiens','polis'));
    }

    public function detailPasien($id = '')
    {
        $pasiens = Pasien::find($id);
        $namaPasien = $pasiens->nama_pasien;
        $riwayats = DB::table('antrians')
            ->where([
                ['id_pasien', '=', $id],
                ['status', '=', '1'],
            ])
            ->first();
        $namaDiagnosa = '';
        if ($riwayats) {
            if (strlen($riwayats->id_icd) > 0) {
                $riwayatExplode = explode(",", $riwayats->id_icd);
                $riwayat = $riwayatExplode[0];
                $diagnosa = Icd::find($riwayat);
                $namaDiagnosa = $diagnosa->diagnosa;
                $namaTindakan = $riwayats->id_tindakan;
                $obatExplode = explode(",", $riwayats->id_obat);
                $obat = $obatExplode[0];
                $obatnew = Obat::find($obat);
                $namaObat = $obatnew->nama_obat;
            }

        }
        $title = "Detail Pasien $namaPasien";
        return view('admin.pasien.detail', compact('title', 'pasiens', 'riwayats', 'namaDiagnosa'));
    }
}
