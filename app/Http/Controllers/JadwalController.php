<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jadwal;
use App\Dokter;
use App\Home;

class JadwalController extends Controller
{

     public function index()
     {
         $title = "Data Jadwal Dokter";
         $jadwals = DB::table('jadwals')
                  ->join('dokters', 'jadwals.id_dokter', '=', 'dokters.id')
                  ->select('jadwals.*', 'dokters.nama_dokter')
                  ->get();
         return view('admin.jadwal.index', compact('title','jadwals'));
     }


     public function create()
     {
         $title = "Form Tambah Jadwal Dokter";
         $dokters = Dokter::all();
         $main = new Home();
         $haris = $main->hari();
         return view('admin.jadwal.create',compact('title','dokters','haris'));
     }


     public function store(Request $request)
     {
         $request->validate([
           'dokter',
           'hari',
         ]);

         $jadwal = new Jadwal([
           'id_dokter' => $request->get('dokter'),
           'hari' => $request->get('hari')
         ]);

         $jadwal->save();

         return redirect('/jadwals')->with('success','Data Jadwal Berhasil Di Tambahkan');
     }


     public function show($id)
     {
         //
     }


     public function edit($id)
     {
         $title = "Edit Data Jadwal Dokter";
         $jadwals = Jadwal::find($id);
         $dokters = Dokter::all();
         $main = new Home();
         $haris = $main->hari();
         return view ('admin.jadwal.edit',compact('title','jadwals','id','dokters','haris'));
     }

     public function update(Request $request, $id)
     {
         $request->validate([
           'id_dokter',
           'hari'
         ]);

         $jadwal = Jadwal::find($id);
         $jadwal->id_dokter = $request->get('dokter');
         $jadwal->hari = $request->get('hari');
         $jadwal->save();

         return redirect('/jadwals')->with('success','Data Jadwal Berhasil Di Ubah');
     }


     public function destroy($id)
     {
         $jadwal = Jadwal::find($id);
         $jadwal->delete();
         return redirect('/jadwals')->with('success','Data Jadwal Berhasil di Hapus');
     }
}
