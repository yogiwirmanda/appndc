@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100 d-flex justify-content-between">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="/tindakans/create" class="btn btn-primary btn-fill">Tambah Tindakan</a>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                No
                            </th>
                            <th>Nama Tindakan</th>
                            <th>Kode Tindakan</th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($tindakans as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->nama_tindakan}}</td>
                                <td>{{$data->kode_tindakan}}</td>
                                <td>
                                    <a href="{{route('tindakans.edit', $data->id)}}" class="btn btn-fill btn-info active"
                                       ui-toggle-class="">Edit</a>
                                    <form action="{{route('tindakans.destroy',$data->id)}}" method="post">
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
