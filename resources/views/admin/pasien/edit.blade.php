@extends('admin.master.main')
@section('content')
    @php
        $dataPembayaran = array('UMUM',"BPJS");
    @endphp
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <form class="form-horizontal bucket-form" method="post" action="{{action('PasienController@update',$id)}}"
                  enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
                <input type="hidden" class="form-control" id="getJk" value="{{$pasiens->jk}}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">No RM</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="no_rm" value="{{$pasiens->no_rm}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nik" value="{{$pasiens->nik}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Pasien</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nama_pasien" value="{{$pasiens->nama_pasien}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-6">
                        <textarea name="alamat" rows="8" cols="80" class="form-control">{{$pasiens->alamat}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="jk" id="jk">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tempat Lahir</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="tempat_lahir" type="text" value="{{$pasiens->tempat_lahir}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="tanggal_lahir" type="date"
                               value="{{$pasiens->tanggal_lahir}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Telepon</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="no_telepon" value="{{$pasiens->no_telepon}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Pekerjaan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pekerjaan" value="{{$pasiens->pekerjaan}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Pembayaran</label>
                    <div class="col-sm-6">
                        <select name="pembayaran" class="form-control" id="pembayaran">
                            @foreach($dataPembayaran as $bayar)
                                @if($bayar === $pasiens->pembayaran)
                                    <option value="{{$bayar}}" selected>{{$bayar}}</option>
                                @else
                                    <option value="{{$bayar}}">{{$bayar}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" id="nobpjs">
                    <label class="col-sm-3 control-label">No BPJS</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="no_bpjs" value="{{$pasiens->no_bpjs}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label">Email / FB</label>
                    <div class="col-sm-6">
                        <input type="text" name="email_fb" class="form-control" value="{{$pasiens->email_fb}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-fill btn-success">Ubah</button>
                        <a href="/pasiens" class="btn btn-fill btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var jk = $("#getJk").val();
            $('#jk option[value=' + jk + ']').attr('selected', true);
            var optionBPJS = '<?php echo $pasiens->pembayaran ?>';
            if (optionBPJS === "BPJS"){
                $('#nobpjs').removeClass('d-none');
            }else{
                $('#nobpjs').addClass('d-none');
            }
        });
        $('#pembayaran').change(function () {
            var value = $(this).val();
            if (value === "BPJS"){
                $('#nobpjs').removeClass('d-none');
            }else{
                $('#nobpjs').addClass('d-none');
            }
        });
    </script>
@endsection
