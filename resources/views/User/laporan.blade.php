@extends('Layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
@endsection

@section('title', 'Laporan')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 col">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    @if (Session::has('pengaduan'))
                    <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                    @endif
                    <div class="mb-3 text-center font-weight-bold">Tulis Laporan Disini</div>
                    <form action="{{ route('pemas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control" rows="4">{{ old('isi_laporan') }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        <a class="d-inline tab {{ $siapa == '' ? "tab-active" : ''}} mr-4" href="{{ route('pemas.laporan') }}">
                            Semua
                        </a>
                        <a class="d-inline tab {{ $siapa == 'me' ? "tab-active" : ''}}" href="{{ route('pemas.laporan', 'me') }}">
                            Laporan Saya
                        </a>
                        <hr>
                    </div>
                    <div class="col-12">
                        <table id="pengaduanTable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengaduan</th>
                                    <th>Nama Pelapor</th>
                                    <th>Isi Laporan</th>
                                    <th>Isi Tanggapan</th>
                                    <th>Tanggal Tanggapan</th>
                                    <th>Hak Akses</th>
                                    <th>Status</th>
                                    <th>Foto Laporan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $k => $v)
                                    <tr>
                                        <td>{{ $k += 1 }}</td>
                                        <td>{{ $v->tgl_pengaduan }}</td>
                                        <td>{{ $v->user->nama}}</td>
                                        <td>{{ $v->isi_laporan }}</td>
                                        <td>
                                            @if (!is_null($v->tanggapan()->first()))
                                                {{ $v->tanggapan()->first()->tanggapan }}
                                                @else
                                                Belum ada tanggapan
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($v->tanggapan()->first()))
                                                {{ date("Y-m-d H:i:s", strtotime($v->tanggapan()->first()->tgl_tanggapan)) }}
                                                @else
                                                Belum ada tanggapan
                                            @endif
                                        </td>
                                        <td>
                                            @if ($v->akses == 'semua')
                                                <a href="" class="label label-success">Semua</a>
                                            @else
                                                <a href="" class="label label-danger">Terbatas</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($v->status == '0')
                                                <a href="" class="label label-danger">Pending</a>
                                            @elseif($v->status == 'proses')
                                                <a href="" class="label label-warning text-white">Proses</a>
                                            @elseif($v->status == 'belum verifikasi')
                                                <a href="" class="label label-danger text-white">Belum diverifikasi</a>
                                            @else
                                                <a href="" class="label label-success">Selesai</a>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset($v->foto) }}" alt="Foto laporan" width="60px">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>
@endif
@endsection
