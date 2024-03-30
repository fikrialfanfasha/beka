<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;

class AdminController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('rekap', compact('jurusans'));
    }

    public function getDataByKelas($kelasId)
    {
        $absensi = Absensi::whereHas('siswa', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        })->get();

        return view('admin.data', compact('absensi'));
    }
}
