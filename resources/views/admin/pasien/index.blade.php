@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100 d-flex justify-content-between">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="/pasiens/create" class="btn btn-primary btn-fill">Tambah Pasien</a>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                No
                            </th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Pembayaran</th>
                            <th style="width:30px;">
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($pasiens as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td><a href="/pasiens/detailPasien/{{$data['id']}}">{{$data['nama_pasien']}}</a></td>
                                <td>{{$data['alamat']}}</td>
                                <td>{{$data['pembayaran']}}</td>
                                <td>
                                    <a href="{{action('PasienController@edit', $data['id'])}}" class="btn btn-info btn-fill"
                                       ui-toggle-class="">Edit</a>
                                    <a href="/pasiens/kunjunganPasien/{{$data['id']}}" class="btn btn-primary btn-fill"
                                       ui-toggle-class="">Kunjungan</a>
                                    <form action="{{route('pasiens.destroy',$data->id)}}" method="post">
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
