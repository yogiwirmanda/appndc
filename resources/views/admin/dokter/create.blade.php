@extends('admin.master.main')
@section('content')
<div class="card">
    <header class="card-header">
        {{$title}}
    </header>
    <div class="card-body">
        <form class="form-horizontal bucket-form" method="post" action="{{url('dokters')}}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Poli</label>
                <div class="col-sm-6">
                    <select name="poli" id="poli" class="form-control">
                        @foreach($polis as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Dokter</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_dokter" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Foto Dokter</label>
                <div class="col-sm-6">
                  <input type="file" name="foto_dokter" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Motto Dokter</label>
                <div class="col-sm-6">
                  <textarea name="motto_dokter" rows="8" cols="80" class="form-control"></textarea>
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
@endsection
