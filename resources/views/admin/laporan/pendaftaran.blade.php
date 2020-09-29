@extends('admin.master.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header w-100 d-flex justify-content-between flex-column">
                    <div class="panel-heading">
                        Filter Data
                    </div>
                    <div class="panel-body">
                        <div class="form-group d-flex">
                            <label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="filterTanggal" id="filterTanggal">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="simpanFilter" class="btn btn-fill btn-info" name="button">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        {{$title}}
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
                            <th>Nama Dokter</th>
                            <th>Tanggal Periksa</th>
                            <th>Status Kehadiran</th>
                            <th>No Antrian</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($laporans as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->nama_pasien}}</td>
                                <td>{{$data->nama_poli}}</td>
                                <td>{{$data->nama_dokter}}</td>
                                <td>{{$data->tanggal}}</td>
                                @php
                                    if($data->status_hadir == 0){
                                        $labelStatus = 'Tidak Hadir';
                                    }else{
                                        $labelStatus = 'Hadir';
                                    }
                                @endphp
                                <td>{{$labelStatus}}</td>
                                <td>{{$data->no_antrian}}</td>
                                {{--<td>--}}
                                    {{--<a href="/pemeriksaans/{{$data->id}}" class="btn btn-fill btn-primary active" ui-toggle-class="">Pemeriksaan</a>--}}
                                {{--</td>--}}
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
            $('#simpanFilter').click(function (e) {
                e.preventDefault();
                var date = $('#filterTanggal').val();
                window.location.href = "/lpendaftarans/laporanHarian/" + date;
            });
        });
    </script>
@endsection
