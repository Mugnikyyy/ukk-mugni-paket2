<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return view('Admin.Masyarakat.index', [
            'masyarakat' => $masyarakat,
        ]);
    }

    public function show($nik)
    {
        $masyarakat = Masyarakat::where('nik', $nik)->first();

        return view('Admin.Masyarakat.show', [
            'masyarakat' => $masyarakat
        ]);
    }

    public function update(Request $request, $nik)
    {
        $masyarakat = Masyarakat::findOrFail($nik);
        $payloadUpdateMasyarakat = $request->all() + [
            'updated_at' => now()
        ];

        $masyarakat->update($payloadUpdateMasyarakat);

        return redirect(route('masyarakat.index'))->with('success', 'Masyarakat berhasil diubah');
    }

    public function destroy($nik)
    {
        $masyarakat = Masyarakat::findOrFail($nik)->delete();

        return redirect(route('masyarakat.index'))->with('success', 'Masyarakat berhasil dihapus');
    }
}
