@extends('admin.master.main')
@section('content')
<div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  {{$title}}
</div>
<div class="row w3-res-tb">
  <div class="col-sm-5 m-b-xs">
    <a href="/obats/create" class="btn btn-primary">Tambah Obat</a>
  </div>
  <div class="col-sm-4">
  </div>
  <div class="col-sm-3">

  </div>
</div>
<div class="table-responsive">
  <table id="datatable">
    <thead>
      <tr>
        <th style="width:20px;">
          No
        </th>
        <th>Nama Obat</th>
        <th>
          Aksi
        </th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
        @foreach($obats as $data)
          <tr>
            <td>{{$i}}</td>
            <td>{{$data->nama_obat}}</td>
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
              <a href="{{route('obats.edit', $data->id)}}" class="active" ui-toggle-class=""><i class="glyphicon glyphicon-pencil text-success text-active"></i></a>
              <a href="{{route('obats.show', $data->id)}}" class="active" ui-toggle-class=""><i class="glyphicon glyphicon-zoom-in text-primary text"></i></a>
              <form action="{{route('obats.destroy',$data->id)}}" method="post">
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
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable').DataTable();
  });
</script>
@endsection
