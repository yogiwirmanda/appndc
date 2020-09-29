@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100 d-flex justify-content-between">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="/pasiens/create" class="btn btn-primary btn-fill">Tambah Pasien</a>
                </div>
                <div class="card-body">
                    <form class="form-horizontal bucket-form" method="post" action="{{url('fantrians')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="aksiFrom" value="backend">
                        <input type="hidden" name="id_pasien" value="{{$idPasien}}">
                        <input type="hidden" name="id_jadwal" id="idJadwal" value="">
                        <div class="form-group">
                            <label class=" col-sm-3 control-label">No RM</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{$pasiens->no_rm}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-3 control-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{$pasiens->nama_pasien}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-3 control-label">Poli</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="poli" id="poli">
                                    <option value="" selected>Pilih Poli</option>
                                    @foreach($polis as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-3 control-label">Dokter</label>
                            <div class="col-sm-6" id="loadJadwalDokter">
                                <select class="form-control" name="dokter" id="dokter">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-3 control-label">Tanggal</label>
                            <div class="col-sm-6">
                                <input type="date" id="tanggal" name="tanggal" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-fill btn-success btn-submit-jadwal" disabled>Tambah</button>
                                <button type="reset" class="btn btn-fill btn-danger">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    $('select#poli').on('change',function (e) {
        e.preventDefault();
        var poli = $(this).val();
        $.ajax({
            url: '/fpasiens/loadJadwalDokter/',
            data: 'poli=' + poli,
            success: function (response) {
                if (response == "NULL") {
                    alert('Tidak Ada Data Dokter');
                    $('#loadJadwalDokter').html('');
                } else {
                    $('#loadJadwalDokter').html('');
                    $('#loadJadwalDokter').html(response);
                }
            }
        });
    });
  $('select#dokter').on('change',function(e){
    var tanggal = $('#tanggal').val();
    var dokter = $(this).val();
  });
  $('#tanggal').on('change',function(e){
    var dokter = $('#dokter').val();
    var tanggal = $(this).val();
    $.ajax({
      url :'/fpasiens/loadJadwal/',
      data :'dokter='+dokter+'&tanggal='+tanggal,
      success : function (response) {
          var data = jQuery.parseJSON(response);
          var typeMessage = data.typeMessage;
          var message = data.message;
          var value = data.value;
          Swal.fire({
              icon: typeMessage,
              text:message
          });
          $('#idJadwal').val(value);
          if(typeMessage === 'success'){
              $('.btn-submit-jadwal').attr('disabled',false);
          }else{
              $('.btn-submit-jadwal').attr('disabled',true);
          }
      }
    });
  });
</script>
@endsection
