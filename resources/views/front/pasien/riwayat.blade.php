@extends('front.master.main')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <p>{{$title}}</p>
            <a href="/fpasiens/show" class="btn btn-fill btn-primary">
                Daftar Baru
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="" class="form-horizontal bucket-form" style="margin-top:1.5rem;">
                    <div class="d-flex">
                        <div class="col-6 col-md-6 col-md-6">
                            <div class="form-group">
                                <label class="col-md-6 control-label">NO RM</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="no_rm"
                                           value="{{$pasiens->no_rm}}" readonly>
                                </div>
                                <label class="col-md-6 control-label">NIK</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="nik"
                                           value="{{$pasiens->nik}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Nama</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="nama"
                                           value="{{$pasiens->nama_pasien}}" readonly>
                                </div>
                                <label class="col-md-6 control-label">No Telepon</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="no_telepon"
                                           value="{{$pasiens->no_telepon}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Pembayaran</label>
                                <div class="col-md-8">
                                    <textarea id="alamat" name="alamat" rows="8" cols="80" class="form-control"
                                              readonly>{{$pasiens->pembayaran}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="col-md-6 control-label">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="jk" value="{{$pasiens->jk}}" readonly>
                                </div>
                                <label class="col-md-6 control-label">Tempat Lahir</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="tempat_lahir" type="text"
                                           value="{{$pasiens->tempat_lahir}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Alamat</label>
                                <div class="col-md-8">
                                    <textarea id="alamat" name="alamat" rows="8" cols="80" class="form-control"
                                              readonly>{{$pasiens->alamat}}</textarea>
                                </div>
                                <label class="col-md-6 control-label">Tanggal Lahir</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="tanggal_lahir" type="date"
                                           value="{{$pasiens->tanggal_lahir}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">No BPJS</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="tanggal_lahir" type="text"
                                           value="{{$pasiens->no_bpjs}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-12 col-md-12 col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>Tanggal</td>
                            <td>Poli</td>
                            <td>Dokter</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if($riwayats)
                            {{--@foreach ($riwayats as $data)--}}
                            <tr>
                                <td>{{$riwayats->tanggal}}</td>
                                <td>{{$poli}}</td>
                                <td>{{$dokter}}</td>
                            </tr>
                            {{--@endforeach--}}
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
