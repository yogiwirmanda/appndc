@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100 d-flex justify-content-between">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="/jadwals/create" class="btn btn-primary btn-fill">Tambah Jadwal</a>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                No
                            </th>
                            <th>Nama Dokter</th>
                            <th>Hari</th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($jadwals as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->nama_dokter}}</td>
                                <td>{{$data->hari}}</td>
                                <td>
                                    <a href="{{route('jadwals.edit', $data->id)}}" class="btn btn-info btn-fill active"
                                       ui-toggle-class="">Edit</a>
                                    <form action="{{route('jadwals.destroy',$data->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-fill" name="submit">Delete</button>
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
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection
