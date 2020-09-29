@extends('admin.master.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$title}}</h4>
        </div>
        <div class="card-body">
            <form class="form-horizontal bucket-form" method="post" action="{{action('DokterController@update',$id)}}" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
                <select name="poli" id="poli" class="form-control">
                    @foreach($polis as $data)
                        @if ($data->id ==+ $dokters->poli)
                            <option value="{{$data->id}}" selected>{{$data->name}}</option>
                        @else
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Dokter</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nama_dokter" value="{{$dokters->nama_dokter}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Foto Dokter</label>
                    <div class="col-sm-6">
                        <input type="file" name="foto_dokter" class="form-control" value="{{$dokters->foto_dokter}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Motto Dokter</label>
                    <div class="col-sm-6">
                        <textarea name="motto_dokter" rows="8" cols="80" class="form-control">{{$dokters->motto_dokter}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-fill btn-success">Tambah</button>
                        <a href="/dokters" class="btn btn-fill btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
