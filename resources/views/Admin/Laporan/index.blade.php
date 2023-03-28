@extends('Layouts.admin')

@section('title', 'Halaman Laporan')

@section('header', 'Data Laporan')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header bg-primary" style="color: white">
                    <div class="text-center">
                        Cari Berdasarkan Tanggal
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.getLaporan') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="from" class="form-control" placeholder="Tanggal Awal"
                                onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <input type="text" name="to" class="form-control" placeholder="Tanggal Akhir"
                                onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <button type="submit" class="btn btn-purple" style="width: 100%">Cari Laporan</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- HALAMAN CETAK LAPORAN --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary" style="color: white">
                    <div class="text-center">Cari Berdasarkan Tanggal</div>
                    <div class="float-right text-end ml-3">
                        @if ($pengaduan ?? '')
                            <a target="_blank" href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to]) }}"
                                class="btn btn-danger">CETAK PDF</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if ($pengaduan ?? '')
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Isi Laporan</th>
                                        <th>Isi Tanggapan</th>
                                        <th>Tanggal Tanggapan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @foreach ($pengaduan as $k => $v)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $v->user->nik }}</td>
                                            <td>{{ $v->user->nama }}</td>
                                            <td>{{ $v->tgl_pengaduan }}</td>
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
                                                @if ($v->status == '0')
                                                    <a href="" class="label label-danger">Pending</a>
                                                @elseif($v->status == 'proses')
                                                    <a href="" class="label label-warning text-white">Proses</a>
                                                @else
                                                    <a href="" class="label label-success">Selesai</a>
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center">
                            Data Tidak Ditemukan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
