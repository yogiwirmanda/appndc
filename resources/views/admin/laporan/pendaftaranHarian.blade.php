@extends('admin.master.main')
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  Filter Data
</div>
<div class="panel-body">
  <div class="form-group d-flex">
      <label class="col-sm-2 control-label">Tanggal</label>
      <div class="col-sm-4">
          <input type="date" class="form-control" name="filterTanggal" id="filterTanggal">
      </div>
      <div class="col-sm-2">
        <button type="button" id="simpanFilter" class="btn btn-info" name="button">Filter</button>
      </div>
  </div>
</div>
<div class="panel-heading">
  {{$title}}
</div>
<div class="row w3-res-tb">
  <div class="col-sm-4">
  </div>
</div>
<div class="table-responsive">
  <table id="datatable">
    <thead>
      <tr>
        <th style="width:20px;">
          No
        </th>
        <th>Nama Pasien</th>
        <th>Nama Dokter</th>
        <th>Tanggal Periksa</th>
        <th>Status Hadir</th>
        <th>No Antrian</th>
        <th>
          Aksi
        </th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
        @foreach($laporans as $data)
          <tr>
            <td>{{$i}}</td>
            <td>{{$data->nama_pasien}}</td>
            <td>{{$data->nama_dokter}}</td>
            <td>{{$data->tanggal}}</td>
            @php
              if($data->status_hadir == 0){
                  $labelStatus = 'Tidak Hadir';
              }else{
                  $labelStatus = 'Hadir';
              }
            @endphp
            <td>{{$labelStatus}}</td>
            <td>{{$data->no_antrian}}</td>
            <td>
                <a href="/pemeriksaans/{{$data->id}}" class="btn btn-primary active" ui-toggle-class="">Pemeriksaan</a>
            </td>
          </tr>
          @php $i++; @endphp
        @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable').DataTable();
    $('#simpanFilter').click(function(e){
      e.preventDefault();
      var date = $('#filterTanggal').val();
      window.location.href = "/lpendaftarans/laporanHarian/"+date;
    });
  });
</script>
@endsection
