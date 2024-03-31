<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Absensi;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ambil semua kelas
        $kelas = Kelas::all();

        // query untuk mendapatkan daftar siswa
        $query = Siswa::query();

        // Periksa apakah ada parameter kelas dalam URL
        if ($request->has('kelas')) {
            //ambil ID kelas berdasarkan nama kelas yang dipilih
            $kelasId = Kelas::where('nama', $request->kelas)->value('id');

            //filter siswa berdasarkan ID kelas
            $query->where('kelas_id', $kelasId);
        }

        //ambil data siswa berdasarkan filter (jika ada)
        $daftarSiswa = $query->paginate(15);
        
        return view('admin.rekap.rekap_index', compact('kelas', 'daftarSiswa'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
