@extends('admin.master.main')
@section('content')
<section class="panel">
    <header class="panel-heading">
        {{$title}}
    </header>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action="{{action('TempatController@update', $id)}}" enctype="multipart/form-data">
          @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Tempat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_tempat" value="{{$tempats->nama_tempat}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Alamat Tempat</label>
                <div class="col-sm-6">
                    <textarea name="alamat" rows="8" cols="80" class="form-control">{{$tempats->alamat}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-success">Tambah</button>
                  <button type="reset" class="btn btn-danger">Batal</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
