<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tindakan;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title = "Data Tindakan";
      $tindakans = Tindakan::all();
      return view('admin.tindakan.index', compact('title','tindakans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $title = "Tambah Data Tindakan";
      return view('admin.tindakan.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'nama_tindakan'=>'required',
          'kode_tindakan'=>'required'
        ]);
        $icd = new Tindakan([
          'nama_tindakan' => $request->get('nama_tindakan'),
          'kode_tindakan' => $request->get('kode_tindakan')
        ]);
        $icd->save();

        return redirect('/tindakans')->with('success','Data Tindakan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Data Tindakan";
        $tindakans = Tindakan::find($id);
        return view ('admin.tindakan.edit',compact('title','tindakans','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'nama_tindakan'=>'required',
          'kode_tindakan'=>'required'
        ]);

        $icd = Tindakan::find($id);
        $icd->nama_tindakan = $request->get('nama_tindakan');
        $icd->kode_tindakan = $request->get('kode_tindakan');
        $icd->save();

        return redirect('/tindakans')->with('success','Data Tindakan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $icd = Tindakan::find($id);
        $icd->delete();
        return redirect('/tindakans')->with('success','Data Tempat Berhasil Di Hapus');
    }
}
