<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Obat";
        $obats = Obat::all();
        return view('admin.obat.index', compact('title','obats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $title = "Tambah Data Obat";
      return view('admin.obat.create',compact('title'));
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
          'nama_obat'=>'required',
        ]);
        $obat = new Obat([
          'nama_obat' => $request->get('nama_obat'),
        ]);
        $obat->save();

        return redirect('/obats')->with('success','Data Obat Berhasil Ditambahkan');
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
        $title = "Edit Data Obat";
        $obats = Obat::find($id);
        return view ('admin.obat.edit',compact('title','obats','id'));
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
          'nama_obat'=>'required',
        ]);

        $obat = Obat::find($id);
        $obat->nama_obat = $request->get('nama_obat');
        $obat->save();

        return redirect('/obats')->with('success','Data Obat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete();
        return redirect('/obats')->with('success','Data Obat Berhasil Di Hapus');
    }
}
