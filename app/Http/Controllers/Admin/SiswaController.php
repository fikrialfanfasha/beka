<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Storage;
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
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|string|unique:siswa',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan hanya gambar yang diizinkan dengan maksimum 2MB
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswa_photos');
        }

        // Buat siswa baru
        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->foto = $fotoPath;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
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
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|string|unique:siswa,nis,' . $id, // Mengabaikan unikitas NIS untuk data dengan ID yang sama
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan hanya gambar yang diizinkan dengan maksimum 2MB
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswa_photos');
        }

        // Temukan siswa yang akan diupdate
        $siswa = Siswa::findOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->kelas_id = $request->kelas_id;

        // Update foto jika ada
        if ($fotoPath) {
            // Hapus foto lama jika ada
            if ($siswa->foto) {
                Storage::delete($siswa->foto);
            }
            $siswa->foto = $fotoPath;
        }

        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
