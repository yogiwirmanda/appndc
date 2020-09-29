@extends('front.master.main')
@section('content')
    @php
        $empty = 'o9wn';
    @endphp
    <div class="card">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center" style="margin-bottom: 5%;border: 1px solid black;padding: 2%;">
                    <b style="font-size:15pt">{{$antrians->nama_pasien}}</b>
                    <div class="text-center">
                        <b style="font-size: 50pt;">{{$noAntrian}}</b>
                    </div>
                    <div class="text-center">
                        {{$antrians->hari.', '.$antrians->tanggal}}
                    </div>
                    <div class="text-center">
                        <p style="margin-bottom: 0px">Poli : {{$antrians->nama_poli}}</p>
                        <p style="margin-bottom: 0px">No RM : {{$antrians->no_rm}}</p>
                        <p>Dokter : {{$antrians->nama_dokter}}</p>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <input type="hidden" id="noAntrian" value="{{$noAntrian}}">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="/fantrians/pdf/{{$noAntrian}}/{{$empty}}/{{$antrians->hari.', '.$antrians->tanggal}}/{{$antrians->nama_dokter}}/{{$antrians->nama_pasien}}/{{$antrians->alamat}}/{{$antrians->nama_poli}}"
                       class="btn btn-fill btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
@endsection
