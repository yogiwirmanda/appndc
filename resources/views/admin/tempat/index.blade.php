@extends('admin.master.main')
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  {{$title}}
</div>
<div class="row w3-res-tb">
  <div class="col-sm-5 m-b-xs">
    <a href="/tempats/create" class="btn btn-primary">Tambah Tempat</a>
  </div>
  <div class="col-sm-4">
  </div>
  <div class="col-sm-3">
    <div class="input-group">
      <input type="text" class="input-sm form-control" placeholder="Search">
      <span class="input-group-btn">
        <button class="btn btn-sm btn-default" type="button">Go!</button>
      </span>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped b-t b-light">
    <thead>
      <tr>
        <th style="width:20px;">
          No
        </th>
        <th>Nama Tempat</th>
        <th>Alamat</th>
        <th>
          Aksi
        </th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
        @foreach($tempats as $data)
          <tr>
            <td>{{$i}}</td>
            <td>{{$data->nama_tempat}}</td>
            <td>{{$data->alamat}}</td>
            <td>
              <!-- <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Aksi
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a href="#">Edit</a><br>
                  <a href="#">Hapus</a><br>
                  <a href="#">Detail</a><br>
                </div>
              </div> -->
              <a href="{{route('tempats.edit', $data->id)}}" class="active" ui-toggle-class=""><i class="glyphicon glyphicon-pencil text-success text-active"></i></a>
              <a href="{{route('tempats.show', $data->id)}}" class="active" ui-toggle-class=""><i class="glyphicon glyphicon-zoom-in text-primary text"></i></a>
              <form action="{{route('tempats.destroy',$data->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="btn btn-danger" name="submit">Delete</button>
              </form>
            </td>
          </tr>
          @php $i++; @endphp
        @endforeach
    </tbody>
  </table>
</div>
<footer class="panel-footer">
  <div class="row">

    <div class="col-sm-5 text-center">
      <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
    </div>
    <div class="col-sm-7 text-right text-center-xs">
      <ul class="pagination pagination-sm m-t-none m-b-none">
        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
        <li><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">4</a></li>
        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
      </ul>
    </div>
  </div>
</footer>
</div>
</div>
@endsection
