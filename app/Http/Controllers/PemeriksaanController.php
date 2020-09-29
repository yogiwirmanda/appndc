<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pemeriksaan;
use App\Icd;
use App\Tindakan;
use App\Obat;
use App\Antrian;
use phpDocumentor\Reflection\Types\Self_;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idAntrian = '')
    {
        if (strlen($idAntrian) == 0) {
            $idAntrian = 3;
        }
        $title = "Data Pemeriksaan";
        $icds = Icd::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();
        $antrians = DB::table('antrians')
            ->where([
                ['antrians.id', '=', $idAntrian]
            ])
            ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
            ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->select('antrians.*', 'dokters.nama_dokter', 'pasiens.nama_pasien', 'pasiens.alamat',
                'pasiens.no_telepon', 'pasiens.tempat_lahir', 'pasiens.tanggal_lahir', 'pasiens.jk','pasiens.no_rm','pasiens.nik')
            ->first();
        return view('admin.pemeriksaan.index', compact('title', 'antrians', 'icds', 'tindakans', 'obats', 'idAntrian'));
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
        $request->validate([
            'id_antrian' => 'required',
            'icd' => 'required',
            'tindakan' => 'required',
            'obat' => 'required',
        ]);

        $antrian = Antrian::find($id);
        $antrian->id_icd = $request->get('icd');
        $antrian->id_tindakan = $request->get('tindakan');
        $antrian->id_obat = $request->get('obat');
        $antrian->save();

        return redirect('/pemeriksaans')->with('success', 'Data Pemeriksaan Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete();
        return redirect('/obats')->with('success', 'Data Pemeriksaan Berhasil Di Hapus');
    }

    public function inputTabel($tabel = '', $id = '', $idAntrian = '')
    {
        $antrian = Antrian::find($idAntrian);
        if ($tabel == "diagnosa") {
            $before = $antrian->id_icd;
            $antrian->id_icd = $id . ',' . $before;
        } else if ($tabel == "tindakan") {
            $before = $antrian->id_tindakan;
            $antrian->id_tindakan = $id;
        } else if ($tabel == "obat") {
            $before = $antrian->id_obat;
            $antrian->id_obat = $id . ',' . $before;
        }
        $antrian->save();
    }

    public function getDiagnosaName($id)
    {
        $diagnosa = Icd::find($id);
        $name = $diagnosa->diagnosa;
        return $name;
    }

    public function getTindakanName($id)
    {
        $tindakan = Tindakan::find($id);
        $name = $tindakan->nama_tindakan;
        return $name;
    }

    public function getObatName($id)
    {
        $obat = Obat::find($id);
        $name = $obat->nama_obat;
        return $name;
    }

    public function loadTabelDiagnosa($idAntrian = '')
    {
        $antrians = Antrian::find($idAntrian);
        $diagnosa = $antrians->id_icd;
        $arr = explode(',', $diagnosa);
        $text = "<table class='table'>";
        $text .= "<thead><th>Diagnosa</th><thead>";
        $text .= "<tbody>";
        $length = count($arr) - 1;
        for ($i = 0; $i < $length; $i++) {
            if ($arr[$i] != "") {
                $itemName = SELF::getDiagnosaName($arr[$i]);
                $text .= "<tr><td>" . $itemName . "</td><td><a id='delRowDiagnosa' href='/pemeriksaans/delRowDiagnosa/$arr[$i]/$idAntrian' class='btn btn-danger'>-</a><td></td></tr>";
            }
        }
        $text .= "</tbody></table>";
        return $text;
    }

    public function loadTabelTindakan($idAntrian = '')
    {
        $antrians = Antrian::find($idAntrian);
        $tindakan = $antrians->id_tindakan;
        $text = "<table class='table'>";
        $text .= "<thead><th>Tindakan</th><thead>";
        $text .= "<tbody>";
        $text .= "<tr><td>".$antrians->id_tindakan."</td><td><a id='delRowObat' href='/pemeriksaans/delRowTindakan/$idAntrian' class='btn btn-danger'>-</a></tr>";
        $text .= "</tbody></table>";
        return $text;
    }

    public function loadTabelObat($idAntrian = '')
    {
        $antrians = Antrian::find($idAntrian);
        $obat = $antrians->id_obat;
        $arr = explode(',', $obat);
        $text = "<table class='table'>";
        $text .= "<thead><th>Obat</th><thead>";
        $text .= "<tbody>";
        $length = count($arr) - 1;
        for ($i = 0; $i < $length; $i++) {
            if ($arr[$i] != '') {
                $itemName = SELF::getObatName($arr[$i]);
                $text .= "<tr><td>" . $itemName . "</td><td><a id='delRowObat' href='/pemeriksaans/delRowObat/$arr[$i]/$idAntrian' class='btn btn-danger'>-</a></tr>";
            }
        }
        $text .= "</tbody></table>";
        return $text;
    }

    public function delRowDiagnosa($idDiagnosa, $idAntrian)
    {
        $antrians = Antrian::find($idAntrian);
        $diagnosa = $antrians->id_icd;
        $cekExplode = str_replace(',', '', $diagnosa);
        $trimDiagnosa = str_replace($idDiagnosa, '', $diagnosa);
        if ($cekExplode <= 1) {
            $trimDiagnosa = "";
        }

        $antrians->id_icd = $trimDiagnosa;
        $antrians->save();

        $title = "Data Pemeriksaan";
        $icds = Icd::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();
        $antrians = DB::table('antrians')
            ->where([
                ['antrians.id', '=', $idAntrian]
            ])
            ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
            ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->select('antrians.*', 'dokters.nama_dokter', 'pasiens.nama_pasien', 'pasiens.alamat',
                'pasiens.no_telepon', 'pasiens.tempat_lahir', 'pasiens.tanggal_lahir', 'pasiens.jk')
            ->first();
        return view('admin.pemeriksaan.index', compact('title', 'antrians', 'icds', 'tindakans', 'obats', 'idAntrian'));
    }

    public function delRowTindakan($idAntrian)
    {
        $antrians = Antrian::find($idAntrian);
        $tindakan = $antrians->id_tindakan;

        $antrians->id_tindakan = "";
        $antrians->save();

        $title = "Data Pemeriksaan";
        $icds = Icd::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();
        $antrians = DB::table('antrians')
            ->where([
                ['antrians.id', '=', $idAntrian]
            ])
            ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
            ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->select('antrians.*', 'dokters.nama_dokter', 'pasiens.nama_pasien', 'pasiens.alamat',
                'pasiens.no_telepon', 'pasiens.tempat_lahir', 'pasiens.tanggal_lahir', 'pasiens.jk')
            ->first();
        return view('admin.pemeriksaan.index', compact('title', 'antrians', 'icds', 'tindakans', 'obats', 'idAntrian'));
    }

    public function delRowObat($idObat, $idAntrian)
    {
        $antrians = Antrian::find($idAntrian);
        $obat = $antrians->id_obat;
        $cekExplode = str_replace(',', '', $obat);
        $trimObat = str_replace($idObat, '', $obat);
        if ($cekExplode <= 1) {
            $trimObat = "";
        }

        $antrians->id_obat = $trimObat;
        $antrians->save();

        $title = "Data Pemeriksaan";
        $icds = Icd::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();
        $antrians = DB::table('antrians')
            ->where([
                ['antrians.id', '=', $idAntrian]
            ])
            ->join('jadwals', 'antrians.id_jadwal', '=', 'jadwals.id')
            ->join('pasiens', 'antrians.id_pasien', '=', 'pasiens.id')
            ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
            ->select('antrians.*', 'dokters.nama_dokter', 'pasiens.nama_pasien', 'pasiens.alamat',
                'pasiens.no_telepon', 'pasiens.tempat_lahir', 'pasiens.tanggal_lahir', 'pasiens.jk')
            ->first();
        return view('admin.pemeriksaan.index', compact('title', 'antrians', 'icds', 'tindakans', 'obats', 'idAntrian'));
    }
}
