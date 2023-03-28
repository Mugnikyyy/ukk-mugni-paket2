@extends('layouts.User')

@section('title', 'Dahsboard')
@section('header', 'Dahsboard')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card-header text-center bg-info text-white"><strong>Pengaduan (Terverifikasi)</strong></div>
            <div class="card-body">
                <div class="text-center"><strong>{{ $hitung[0] }}</strong></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card-header text-center bg-danger text-white"><strong>Pengaduan (Pending)</strong></div>
            <div class="card-body">
                <div class="text-center"><strong>{{ $hitung[0] }}</strong></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card-header text-center text-white bg-warning">Pengaduan (Proses)</div>
            <div class="card-body">
                <div class="text-center"><strong>{{ $hitung[1] }}</strong></div>
            </div>
        </div>  
        <div class="col-lg-3">
            <div class="card-header text-center text-white bg-success">Pengaduan (Selesai)</div>
            <div class="card-body">
                <div class="text-center"><strong>{{ $hitung[2] }}</strong></div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card-header text-center bg-info text-white"><strong>Jumlah Semua Laporan</strong></div>
            <div class="card-body">
                <div class="text-center"><strong>{{ $hitung[3] }}</strong></div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card-header text-center bg-danger text-white"><strong>Jumlah Semua Tanggapan</strong></div>
            <div class="card-body">
                <div class="text-center"><strong>{{ $hitung[4] }}</strong></div>
            </div>
        </div>
    </div>
@endsection
