@extends('front.master.main')
@section('content')
    @php
        $show = 0;
        $getMessage = '';
        if (Session::get('success')){
            $show = 1;
            $getMessage = Session::get('success');
        }
    @endphp
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <form class="form-horizontal bucket-form" method="post" action="{{url('fantrians')}}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="aksiFrom" value="frontend">
                <input type="hidden" name="id_pasien" value="{{Session::get('idPasien')}}">
                <input type="hidden" name="id_jadwal" id="idJadwal" value="">
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
                            {{--@foreach($dokters as $data)--}}
                            {{--<option value="{{$data->id}}">{{$data->nama_dokter}}</option>--}}
                            {{--@endforeach--}}
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
                        <a href="/fpasiens" class="btn btn-fill btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var show = '<?php echo $show  ?>';
            var message = '<?php echo $getMessage ?>';
            if (show === '1') {
                Swal.fire(message);
            }
        });
        $('select#poli').on('change', function (e) {
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
        $('select#dokter').on('change', function (e) {
            var tanggal = $('#tanggal').val();
            var dokter = $(this).val();
        });
        $('#tanggal').on('change', function (e) {
            var dokter = $('#dokter').val();
            var tanggal = $(this).val();
            $.ajax({
                url: '/fpasiens/loadJadwal/',
                data: 'dokter=' + dokter + '&tanggal=' + tanggal,
                success: function (response) {
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
