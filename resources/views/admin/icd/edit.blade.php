@extends('admin.master.main')
@section('content')
<section class="panel">
    <header class="panel-heading">
        {{$title}}
    </header>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action="{{action('IcdController@update', $id)}}" enctype="multipart/form-data">
          @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label class="col-sm-3 control-label">Diagnosa</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="diagnosa" value="{{$icds->diagnosa}}">
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-success">Tambah</button>
                  <a href="/icds" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
