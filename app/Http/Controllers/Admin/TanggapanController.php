<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();


        if (!is_null($tanggapan)) {
            $pengaduan->update([
                'status' => $request->status,
                'akses' => $request->akses,
                'tgl_proses' => $request->tgl_proses .' '. date("H:i:s"),
                'tgl_selesai' => $request->tgl_selesai .' '. date("H:i:s"),
            ]);

            $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d H:i:s'),
                'tanggapan' => $request->tanggapan,
                'akses' => $request->akses,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            // dd($pengaduan);


            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim!'])->with('success', 'Berhasil kirim tanggapan');
        } else {
            $pengaduan->update([
                'status' => $request->status,
                'akses' => $request->akses,
                'tgl_proses' => $request->tgl_proses .' '. date("H:i:s"),
                'tgl_selesai' => $request->tgl_selesai .' '. date("H:i:s"),
                'status' => $request->status,
            ]);

            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d H:i:s'),
                'tanggapan' => $request->tanggapan,
                'akses' => $request->akses,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim!'])->with('success', 'Berhasil kirim tanggapan');
        }
    }
}
