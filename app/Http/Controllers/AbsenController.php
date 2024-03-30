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
    // Menyimpan data absensi
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'tanggal' => 'required|date',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'status_absen.*' => 'required|in:hadir,sakit,izin,alfa'
        ]);

        // Periksa apakah sudah ada absensi untuk siswa pada tanggal yang sama
        foreach ($request->status_absen as $siswaId => $status) {
            $existingAbsensi = Absensi::where('siswa_id', $siswaId)
                ->where('tanggal', $request->tanggal)
                ->exists();

            // Jika sudah ada, kembalikan respon dengan pesan error
            if ($existingAbsensi) {
                return redirect()->back()->with('error', 'Absensi untuk siswa pada tanggal yang sama sudah ada.');
            }
        }

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
