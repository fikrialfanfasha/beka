<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Jurusan;

class AbsenController extends Controller
{
    public function create()
    {
        $jurusan = Jurusan::all();
        // dd($jurusan);
        return view('siswa.absen', compact('jurusan'));
    }

    // Menyimpan data absensi
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $request->validate([
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'tanggal' => 'required|date',
            'status_absen' => 'required|array',
            'status_absen.*' => 'required|in:hadir,sakit,izin,alfa'
        ]);

        // Proses menyimpan data absensi untuk setiap siswa
        foreach ($request->status_absen as $siswaId => $status) {
            Absensi::create([
                'siswa_id' => $siswaId,
                'tanggal' => $request->tanggal,
                'status' => $status
            ]);
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }

    // Menampilkan kelas berdasarkan jurusan
    public function getKelasByJurusan($jurusanId)
    {
        $kelas = Kelas::where('jurusan_id', $jurusanId)->pluck('nama', 'id');
        return response()->json($kelas);
    }

    // Menampilkan siswa berdasarkan kelas
    public function getSiswaByKelas($kelasId)
    {
        $siswa = Siswa::where('kelas_id', $kelasId)->pluck('nama', 'id');
        return response()->json($siswa);
    }
}
