@extends('admin.master.main')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-info" style="text-align:center;">
      <h2>Daftar Pasien Hari Ini</h2>
      <h2>{{$pa_today}}</h2>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-info" style="text-align:center;">
      <h2>Daftar Pasien Yang Di Periksa Hari Ini</h2>
      <h2>{{$pa_cek_today}}</h2>
    </div>
  </div>
</div>
@endsection
