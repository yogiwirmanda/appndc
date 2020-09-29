@extends('admin.master.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <form class="form-horizontal bucket-form" method="post" action="{{url('pasiens')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-3 control-label">No RM</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="no_rm" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nik" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Pasien</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nama_pasien" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="jk">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-6">
                        <textarea name="alamat" rows="8" cols="80" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tempat Lahir</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="tempat_lahir" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="tanggal_lahir" type="date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Telepon</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="no_telepon" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Pekerjaan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pekerjaan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Pembayaran</label>
                    <div class="col-sm-6">
                        <select name="pembayaran" class="form-control" id="pembayaran">
                            <option value="UMUM">UMUM</option>
                            <option value="BPJS">BPJS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group d-none" id="nobpjs">
                    <label class="col-sm-3 control-label">No BPJS</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="no_bpjs" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label">Email / FB</label>
                    <div class="col-sm-6">
                        <input type="text" name="email_fb" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-fill btn-success">Tambah</button>
                        <button type="reset" class="btn btn-fill btn-danger">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
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
