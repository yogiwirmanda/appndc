@extends('admin.master.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <form class="form-horizontal bucket-form" method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 col-md- col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" value="{{$pasiens->nama_pasien}}" readonly>
                            </div>
                            <label class="col-sm-6 control-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_telepon" value="{{$pasiens->no_telepon}}"
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jk" value="{{$pasiens->jk}}" readonly>
                            </div>
                            <label class="col-sm-6 control-label">Tempat Lahir</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="tempat_lahir" type="text" value="{{$pasiens->tempat_lahir}}"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md- col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Alamat</label>
                            <div class="col-sm-8">
                        <textarea id="alamat" name="alamat" rows="8" cols="80" class="form-control"
                                  readonly>{{$pasiens->alamat}}</textarea>
                            </div>
                            <label class="col-sm-6 control-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="tanggal_lahir" type="date" value="{{$pasiens->tanggal_lahir}}"
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Jenis Pembayaran</label>
                            <div class="col-sm-8">
                        <textarea id="alamat" name="alamat" rows="8" cols="80" class="form-control"
                                  readonly>{{$pasiens->pembayaran}}</textarea>
                            </div>
                            <label class="col-sm-6 control-label">No BPJS</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="tanggal_lahir" type="text" value="{{$pasiens->no_bpjs}}"
                                       readonly>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped" id="datatable">
                <thead>
                <th>Tanggal</th>
                <th>Poli</th>
                <th>Dokter</th>
                </thead>
                <tbody>
                @if($riwayats)
                    @if(strlen($riwayats->id_icd)>0)
                        <tr>
                            <td>{{$data->tanggal}}</td>
                            <td>{{$data->poli}}</td>
                            <td>{{$data->dokter}}</td>
                        </tr>
                    @endif
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
