<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tempat;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $title = "Data Tempat";
        $tempats = Tempat::all();
        return view('admin.tempat.index', compact('title','tempats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Data Tempat";
        return view('admin.tempat.create',compact('title'));
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
          'nama_tempat'=>'required',
          'alamat'=>'required'
        ]);
        $tempat = new Tempat([
          'nama_tempat' => $request->get('nama_tempat'),
          'alamat' => $request->get('alamat')
        ]);
        $tempat->save();

        return redirect('/tempats')->with('success','Data Tempat Berhasil Ditambahkan');
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
        $title = "Edit Data Tempat";
        $tempats = \App\Tempat::find($id);
        return view ('admin.tempat.edit',compact('title','tempats','id'));
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
          'nama_tempat'=>'required',
          'alamat'=>'required'
        ]);

        $tempat = Tempat::find($id);
        $tempat->nama_tempat = $request->get('nama_tempat');
        $tempat->alamat = $request->get('alamat');
        $tempat->save();

        return redirect('/tempats')->with('success','Data Tempat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempat = Tempat::find($id);
        $tempat->delete();
        return redirect('/tempats')->with('success','Data Tempat Berhasil Di Hapus');
    }
}
