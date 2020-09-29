<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ICD;

class IcdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title = "Data ICD";
      $icds = ICD::all();
      return view('admin.icd.index', compact('title','icds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $title = "Tambah Data Icd";
      return view('admin.icd.create',compact('title'));
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
          'diagnosa'=>'required',
        ]);
        $icd = new ICD([
          'diagnosa' => $request->get('diagnosa'),
          'kode' => ""
        ]);
        $icd->save();

        return redirect('/icds')->with('success','Data ICD Berhasil Ditambahkan');
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
        $title = "Edit Data ICD";
        $icds = ICD::find($id);
        return view ('admin.icd.edit',compact('title','icds','id'));
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
          'diagnosa'=>'required',
        ]);

        $icd = ICD::find($id);
        $icd->diagnosa = $request->get('diagnosa');
        $icd->kode = "";
        $icd->save();

        return redirect('/icds')->with('success','Data ICD Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $icd = ICD::find($id);
        $icd->delete();
        return redirect('/icds')->with('success','Data Tempat Berhasil Di Hapus');
    }
}
