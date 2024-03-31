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
    
        // periksa apakah ada parameter kelas dalam URL
        if ($request->has('kelas')) {
            // kalo ada, ambil ID kelas berdasarkan nama kelas yang dipilih
            $kelasId = Kelas::where('nama', $request->input('kelas'))->value('id');
    
            //filter siswa berdasarkan ID kelas
            $siswa->where('kelas_id', $kelasId);
        }
    
        //ambil semua kelas
        $kelas = Kelas::all();
    
        //ambil data siswa berdasarkan filter (jika ada)
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
        //validasi input
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|string|unique:siswa',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // hanya gambar yang diizinkan dengan maksimum 2MB
        ]);

        //upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswa_photos');
        }

        //buat data siswa baru
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
        //validasi input
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|string|unique:siswa,nis,' . $id, //NIS 
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', //hanya gambar yang diizinkan dengan maksimum 2MB
        ]);

        //up foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswa_photos');
        }

        //find data siswa yang akan diupdate
        $siswa = Siswa::findOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->kelas_id = $request->kelas_id;

        //update foto jika ada
        if ($fotoPath) {
            //hapus foto lama jika ada
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
