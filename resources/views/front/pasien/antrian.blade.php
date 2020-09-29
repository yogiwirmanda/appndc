@extends('front.master.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <b style="font-size:15pt;">{{$antrians->nama_pasien}}</b><br>
                    <b style="font-size:15pt;">{{$antrians->alamat}}</b><br><br>
                    <b>JADWAL PERIKSA</b><br>
                    <h4>Poli : {{$antrians->nama_poli}}</h4>
                    <h4>No RM : {{$antrians->no_rm}}</h4><br><br>
                    <div class="d-flex justify-content-around">
                        <div class="col-md-4">
                            <span>
                                <i class="nc-icon nc-single-02" style="font-size:40pt"></i>
                            </span><br>
                            {{$antrians->nama_dokter}}
                        </div>
                        <div class="col-md-4">
                            <span>
                                <i class="nc-icon nc-notification-70" style="font-size:40pt"></i>
                            </span><br>
                            {{$antrians->hari.', '.$antrians->tanggal}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center" style="margin-top: 5%;">
                    <a href="/fantrians/confirm/{{$antrians->id}}/{{$antrians->id_pasien}}" class="btn btn-fill btn-primary">Daftar
                        Sekarang</a>
                    <a href="" class="btn btn-fill btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </div>
@endsection
