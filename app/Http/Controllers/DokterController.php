<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Poli;
use File;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DokterController extends Controller
{

    public $path;
    public $dimensions;

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = storage_path('app/public/images');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['245', '300', '500'];
    }

    public function index()
    {
      $title = "Data Dokter";
      $dokters = DB::table('dokters')
                ->join('polis','dokters.poli','=','polis.id')
                ->select('dokters.*','polis.name AS nama_poli')
                ->get();
      return view('admin.dokter.index', compact('title','dokters'));
    }

    public function create()
    {
        $title = "Tambah Data Dokter";
        $polis = Poli::all();
        return view('admin.dokter.create', compact('title','polis'));
    }

    public function store(Request $request)
    {
      $request->validate([
        'nama_dokter'=>'required'
      ]);

      $file = $request->file('foto_dokter');
      if ($file){
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
          Image::make($file)->save(public_path() . '/storage/dokter/'. $fileName);
          $resizeImage = Image::make($file)->resize(1280, 716, function ($constraint) {
              $constraint->aspectRatio();
          });
      }else{
          $fileName = '';
      }

      $dokter = new Dokter([
        'poli' => $request->get('poli'),
        'nama_dokter' => $request->get('nama_dokter'),
        'foto_dokter' => $fileName,
        'motto_dokter' => $request->get('motto_dokter')
      ]);

        $dokter->save();
      return redirect('/dokters')->with('success','Data Dokter Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $title = "Edit Data Dokter";
      $dokters = Dokter::find($id);
      $polis = Poli::all();
      return view ('admin.dokter.edit',compact('title','dokters','id','polis'));
    }

    public function update(Request $request, $id)
    {
      $request->validate([
        'nama_dokter'=>'required'
      ]);

        $file = $request->file('foto_dokter');
        if (isset($file)){
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save(public_path() . '/storage/dokter/'. $fileName);
            $resizeImage = Image::make($file)->resize(1280, 716, function ($constraint) {
                $constraint->aspectRatio();
            });
        }else{
            $getFotoDokter = Dokter::find($id);
            $fileName = $getFotoDokter->foto_dokter;
        }

      $dokter = Dokter::find($id);
      $dokter->poli = $request->get('poli');
      $dokter->nama_dokter = $request->get('nama_dokter');
      $dokter->foto_dokter = $fileName;
      $dokter->motto_dokter = $request->get('motto_dokter');
      $dokter->save();

      return redirect('/dokters')->with('success','Data Dokter Berhasil Diubah');
    }

    public function destroy($id)
    {
        $dokters = Dokter::find($id);
        $dokters->delete();
        return redirect('/dokters')->with('success','Data Dokter Berhasil Di Hapus');
    }
}
