@extends('admin.master.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <form class="form-horizontal bucket-form" method="post" action="{{url('tindakans')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Tindakan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nama_tindakan">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Kode Tindakan</label>
                    <div class="col-sm-6">
                        <textarea name="kode_tindakan" rows="8" cols="80" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-fill btn-success">Tambah</button>
                        <a href="/tindakans" class="btn btn-fill btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
