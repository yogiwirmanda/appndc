@extends('front.master.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-header">
                {{$title}}
            </div>
            <div class="card-body">
                <div class="w-100 d-flex justify-content-around">
                    <a href="/fpasiens/login" class="btn btn-fill btn-primary">
                        <span><i class="nc-icon nc-badge"></i></span><br>
                        Pasien Lama
                    </a>
                    <a href="/fpasiens/create" class="btn btn-fill btn-primary">
                        <span><i class="nc-icon nc-badge"></i></span><br>
                        Pasien Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
