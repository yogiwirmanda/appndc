@extends('admin.master.main')
@section('content')
<section class="panel">
    <header class="panel-heading">
        {{$title}}
    </header>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action="{{action('ObatController@update', $id)}}" enctype="multipart/form-data">
          @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_obat" value="{{$obats->nama_obat}}">
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-success">Tambah</button>
                  <a href="/obats" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
