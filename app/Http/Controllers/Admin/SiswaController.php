<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswa = Siswa::query();

        // Memeriksa apakah ada parameter kelas dalam URL
        if ($request->has('kelas')) {
            // Jika ada, filter berdasarkan kelas yang dipilih
            $siswa->whereHas('kelas', function ($query) use ($request) {
                $query->where('id', $request->input('kelas'));
            });
        }

        // Ambil semua kelas
        $kelas = Kelas::all();

        // Ambil siswa berdasarkan filter (jika ada)
        $siswa = $siswa->get();

        return view('admin.siswa.siswa_index', compact('siswa', 'kelas'));
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
