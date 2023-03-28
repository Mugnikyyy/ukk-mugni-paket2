@extends('layouts.admin')

@section('title', 'Detail Masyarakat')

@section('css')
    <style>
        .text-primary:hover {
            text-decoration: underline;
        }

        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
        }

        .btn-purple {
            background: #6a70fc;
            border: 1px solid #6a70fc;
            color: #fff;
            width: 100%;
        }
    </style>
@endsection

@section('header')
    <a href="{{ route('masyarakat.index') }}" class="text-primary">Data Masyarakat</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Detail Masyarakat</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Detail Masyarakat
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('masyarakat.update', ['masyarakat' => $masyarakat->nik]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>NIK</th>
                                    <td>:</td>
                                    <td><input type="text" name="nik" class="form-control" value="{{ $masyarakat->nik }}"></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td><input type="text" name="nama" class="form-control" value="{{ $masyarakat->nama }}"></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>:</td>
                                    <td><input type="text" name="username" class="form-control" value="{{ $masyarakat->username }}"></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>:</td>
                                    <td>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="Laki-Laki" @selected($masyarakat->jenis_kelamin == 'Laki-Laki')>Laki - laki</option>
                                            <option value="Perempuan" @selected($masyarakat->jenis_kelamin == 'Perempuan')>Perempuan</option>    
                                        </select>    
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telp</th>
                                    <td>:</td>
                                    <td><input type="number" name="telp" class="form-control" value="{{ $masyarakat->telp }}"></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td><input type="text" name="alamat" class="form-control" value="{{ $masyarakat->alamat }}"></td>
                                </tr>
                            </tbody>
                        </table>
    
                        <button type="submit" class="btn btn-warning w-100">Update</button>
                    </form>

                    <form action="{{ route('masyarakat.destroy', ['masyarakat' => $masyarakat->nik]) }}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger mt-2" style="width: 100%">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
