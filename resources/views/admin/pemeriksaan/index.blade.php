@extends('admin.master.main')
@section('content')
<div class="card">
    <div class="card-header">
        {{$title}}
    </div>
    <div class="card-body">
        <form class="form-horizontal bucket-form" method="post" action="{{action('PemeriksaanController@update',$idAntrian)}}" enctype="multipart/form-data">
          @csrf
            <input name="_method" type="hidden" value="PATCH">
            <input type="hidden" id="idAntrian" value="{{$idAntrian}}">
            <div class="form-group">
                <label class="col-sm-2 control-label">NO RM</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="no_rm"
                           value="{{$antrians->no_rm}}" readonly>
                </div>
                <label class="col-sm-2 control-label">NIK</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="nik"
                           value="{{$antrians->nik}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="nama" value="{{$antrians->nama_pasien}}" readonly>
                </div>
                <label class="col-sm-2 control-label">No Telepon</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="no_telepon" value="{{$antrians->no_telepon}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="jk" value="{{$antrians->jk}}" readonly>
                </div>
                <label class="col-sm-2 control-label">Tempat Lahir</label>
                <div class="col-sm-3">
                    <input class="form-control" name="tempat_lahir" type="text" value="{{$antrians->tempat_lahir}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-3">
                    <textarea id="alamat" name="alamat" rows="8" cols="80" class="form-control" readonly>{{$antrians->alamat}}</textarea>
                </div>
                <label class="col-sm-2 control-label">Tanggal Lahir</label>
                <div class="col-sm-3">
                    <input class="form-control" name="tanggal_lahir" type="date" value="{{$antrians->tanggal_lahir}}" readonly>
                </div>
            </div>
            <hr>
            <input type="hidden" name="id_antrian" value="{{$antrians->id}}">
            <div class="form-group">
                <label class="col-sm-2 control-label">Dokter</label>
                <div class="col-sm-3">
                    <input class="form-control" name="dokter" type="text" value="{{$antrians->nama_dokter}}" readonly>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Diagnosa</label>
              <div class="col-sm-3">
                <select id="diagnosa" class="form-control">
                  @foreach($icds as $diagnosa)
                    <option value="{{$diagnosa->id}}">{{$diagnosa->diagnosa}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-1">
                <button type="button" class="btn btn-info" id="btnDiagnosa">+</button>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-3">
                <div id="tabelDiagnosa">

                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tindakan</label>
              <div class="col-sm-3">
                  <textarea name="tindakan" id="tindakan" cols="30" rows="10" class="form-control"></textarea>
              </div>
              <div class="col-sm-1">
                <button type="button" class="btn btn-info" id="btnTindakan">+</button>
              </div>
              <label class="col-sm-1 control-label">Obat</label>
              <div class="col-sm-3">
                <select id="obat" class="form-control">
                  @foreach($obats as $obat)
                    <option value="{{$obat->id}}">{{$obat->nama_obat}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-1">
                <button type="button" class="btn btn-info" id="btnObat">+</button>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-3">
                <div id="tabelTindakan">

                </div>
              </div>
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-3">
                <div id="tabelObat">

                </div>
              </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-2 control-label"></label>
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-fill btn-success">Tambah</button>
                  <button type="reset" class="btn btn-fill btn-danger">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable').DataTable();
    var idAntrian = $('#idAntrian').val();
    $('#tabelDiagnosa').load('/pemeriksaans/loadTabelDiagnosa/'+idAntrian);
    $('#tabelTindakan').load('/pemeriksaans/loadTabelTindakan/'+idAntrian);
    $('#tabelObat').load('/pemeriksaans/loadTabelObat/'+idAntrian);
  });
  $("#btnDiagnosa").click(function(){
    var idAntrian = $('#idAntrian').val();
    var diagnosa = $('select#diagnosa option:selected').val();
    $.ajax({
      url :'/pemeriksaans/inputTabel/diagnosa/'+diagnosa+'/'+idAntrian,
      success : function (response) {
        $('#tabelDiagnosa').load('/pemeriksaans/loadTabelDiagnosa/'+idAntrian);
      }
    });
  });

  $("#btnTindakan").click(function(){
    var idAntrian = $('#idAntrian').val();
    var tindakan = $('#tindakan').val();
    $.ajax({
      url :'/pemeriksaans/inputTabel/tindakan/'+tindakan+'/'+idAntrian,
      success : function (response) {
        $('#tabelTindakan').load('/pemeriksaans/loadTabelTindakan/'+idAntrian);
      }
    });
  });

  $("#btnObat").click(function(){
    var idAntrian = $('#idAntrian').val();
    var obat = $('select#obat option:selected').val();
    $.ajax({
      url :'/pemeriksaans/inputTabel/obat/'+obat+'/'+idAntrian,
      success : function (response) {
        $('#tabelObat').load('/pemeriksaans/loadTabelObat/'+idAntrian);
      }
    });
  });
</script>
@endsection
