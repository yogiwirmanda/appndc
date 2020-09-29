@extends('admin.master.main')
@section('content')
<section class="panel">
    <header class="panel-heading">
        {{$title}}
    </header>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action="{{url('icds')}}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Diagnosa</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="diagnosa" required>
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
