@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100 d-flex justify-content-between">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="/dokters/create" class="btn btn-primary btn-fill">Tambah Dokter</a>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                No
                            </th>
                            <th>Nama Dokter</th>
                            <th>Poli</th>
                            <th>Motto Dokter</th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($dokters as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->nama_dokter}}</td>
                                <td>{{$data->nama_poli}}</td>
                                <td>{{$data->motto_dokter}}</td>
                                <td>
                                    <a href="{{route('dokters.edit', $data->id)}}" class="btn btn-info btn-fill"
                                       ui-toggle-class="">Edit</a>
                                    <form action="{{route('dokters.destroy',$data->id)}}" method="post">
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
