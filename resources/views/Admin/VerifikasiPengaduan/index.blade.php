@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

@endsection

@section('title', 'Data Pengaduan Belum Diverifikasi')

@section('header', 'Data Pengaduan Belum Diverifikasi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="pengaduanTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengaduan</th>
                                <th>Nama Pelapor</th>
                                <th>Isi Laporan</th>
                                <th>Hak Akses</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $k => $v)
                                <tr>
                                    <td>{{ $k += 1 }}</td>
                                    <td>{{ $v->tgl_pengaduan }}</td>
                                    <td>{{ $v->user->nama }}</td>
                                    <td>{{ $v->isi_laporan }}</td>
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
                                        @else
                                            <a href="" class="label label-danger">{{ $v->status }}</a>
                                        @endif
                                    </td>
                                    <td class="d-flex jutify-content-center">

                                        <form id="verif-form-{{ $v->id_pengaduan }}" action="{{ route('verifikasi-pengaduan.update', ['verifikasi_pengaduan' => $v->id_pengaduan]) }}" class="d-none" method="post">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        <button onclick="verifikasiPengaduan('{{$v->id_pengaduan}}')" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Verifikasi</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#pengaduanTable').DataTable();
        });

        function verifikasiPengaduan(id) {
            Swal.fire({
                title: 'Verifikasi Pengaduan',
                text: "Anda akan Memverifikasi Pengaduan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#verif-form-${id}`).submit()
                }
            })
        }
    </script>
@endsection
