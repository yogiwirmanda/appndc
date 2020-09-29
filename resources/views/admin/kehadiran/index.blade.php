@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100">
                    <h4 class="card-title">{{$title}}</h4>
                    <div class="panel-body">
                        <div class="form-group d-flex mt-2">
                            <label class="align-content-center">Filter Tanggal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="filterTanggal" id="filterTanggal">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="simpanFilter" class="btn btn-fill btn-info" name="button">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                No
                            </th>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($dataAntrian as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->nama_pasien}}</td>
                                <td>{{$data->nama_poli}}</td>
                                <td>{{$data->nama_dokter}}</td>
                                @php
                                    if($data->status_hadir == 0){
                                        $labelStatus = 'Tidak Hadir';
                                    }else{
                                        $labelStatus = 'Hadir';
                                    }
                                @endphp
                                <td>{{$labelStatus}}</td>
                                <td>
                                    <a href="{{route('kehadirans.edit', $data->antrianId)}}" class="btn btn-info btn-fill active"
                                       ui-toggle-class="">Hadir</a>
                                    <a href="{{route('kehadirans.edit', $data->antrianId)}}" class="btn btn-danger btn-fill active"
                                       ui-toggle-class="">Tidak Hadir</a>
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
            $('#simpanFilter').click(function () {
               var date = $('#filterTanggal').val();
               window.location.href = '/kehadirans/index/'+date;
            });
        });
    </script>
@endsection
