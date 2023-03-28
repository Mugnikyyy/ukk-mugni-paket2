<?php

namespace App\Http\Controllers\User;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all()->count();

        return view('User.landing', [
            'pengaduan' => $pengaduan,
            'tanggapan' => Tanggapan::count(),
        ]);
    }

    public function loginView()
    {
        return view('User.login');
    }

    public function login(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect(route('dashboard.masyarakat'))->with('success', 'Selamat datang ' . Auth::guard('masyarakat')->user()->nama);
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function formRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required'],
            'nama' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'jenis_kelamin' => ['required'],
            'telp' => ['required'],
            'alamat' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = Masyarakat::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'jenis_kelamin' => $data['jenis_kelamin'],
            'telp' => $data['telp'],
            'alamat' => $data['alamat']
        ]);

        return redirect()->route('pemas.index')->with('success', 'Berhasil registrasi, silahkan masuk untuk melanjutkan');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect(route('pemas.index'))->with('success', 'Berhasil keluar');
    }

    public function storePengaduan(Request $request)
    {
        if (!Auth::guard('masyarakat')->user()) {
            return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }

        $data = $request->all();

        $validate = Validator::make($data, [
            'isi_laporan' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $fileImage = hexdec(uniqid()) . "." . $request->foto->extension();
        Image::make($request->file('foto'))->save('assets/images/' . $fileImage);
        $pengaduanImage = 'assets/images/' . $fileImage;

        $data['foto'] = $pengaduanImage;

        // if ($request->file('foto')) {
        //     $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        // }


        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' =>  Carbon::now()->format("Y-m-d H:i:s"),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? '',
            'status' => 'belum verifikasi',
            'akses' => '0',
        ]);

        if ($pengaduan) {
            return redirect()->route('pemas.laporan', 'me')->with(['pengaduan' => 'Pengaduan Berhasil terkirim!', 'type' => 'success'])->with('success', 'Berhasil kirim pengaduan');
        } else {
            return redirect()->back()->with(['pengaduan' => 'Pengaduan Gagal terkirim!', 'type' => 'danger'])->with('error', 'Pengaduan gagal dikirim');
        }
    }

    public function laporan($siapa = '')
    {
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else if($siapa == ''){
            $pengaduan = Pengaduan::where('status', '!=', 'belum verifikasi')->where('akses', 'semua')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }

    public function dashboard()
    {
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $jmlAdu = Pengaduan::count();
        $jmlTanggapan = Tanggapan::count();

        $hitung = [$terverifikasi, $proses, $selesai, $jmlAdu, $jmlTanggapan];

        return view('User.Dashboard.index', compact('hitung'));
    }

    public function tambahPengaduanView()
    {
        return view('User.Dashboard.tambah-pengaduan');
    }
}
