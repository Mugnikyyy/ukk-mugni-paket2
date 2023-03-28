@extends('layouts.User')

@section('title', 'Tambah Pengaduan')
@section('header', 'Tambah Pengaduan')

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <form action="{{ route('pemas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-header">
            <h4>Tulis Laporan di sini</h4>
          </div>
          <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif
                @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                    @endif

                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control" rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="foto" class="form-control">
                </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary btn-lg">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
