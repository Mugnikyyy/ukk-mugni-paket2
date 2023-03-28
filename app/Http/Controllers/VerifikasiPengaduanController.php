<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class VerifikasiPengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->where('status', 'belum verifikasi')->paginate(5);
        // dd($pengaduan);
        return view('Admin.VerifikasiPengaduan.index', [
            'pengaduan' => $pengaduan
        ]);
    }

    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('Admin.VerifikasiPengaduan.show', [
            'pengaduan' => $pengaduan,
            'tanggapan' => $tanggapan,
        ]);
    }

    public function update($pengaduanId)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduanId);

        $pengaduan->update([
            'status' => '0',
            'updated_at' => now()
        ]);

        return redirect(route('verifikasi-pengaduan.index'))->with('success', 'Pengaduan berhasil diverifikasi');
    }
}
