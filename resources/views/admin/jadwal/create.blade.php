@extends('admin.master.main')
@section('content')
<div class="card">
    <div class="card-header">
        {{$title}}
    </div>
    <div class="card-body">
        <form class="form-horizontal bucket-form" method="post" action="{{url('jadwals')}}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Dokter</label>
                <div class="col-sm-6">
                    <select name="dokter" class="form-control">
                      @foreach($dokters as $dokter)
                        <option value="{{$dokter->id}}">{{$dokter->nama_dokter}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Hari</label>
                <div class="col-sm-3">
                    <select name="hari" class="form-control">
                      @php $i=0; @endphp
                        @foreach($haris as $hari)
                          <option value="{{$hari}}">{{$hari}}</option>
                        @php $i++; @endphp
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-fill btn-success">Tambah</button>
                    <a href="/jadwals" class="btn btn-fill btn-danger">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
