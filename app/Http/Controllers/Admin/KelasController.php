<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Jurusan;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();

        //filter berdasarkan jurusan jika dipilih
        if ($request->has('jurusan')) {
            $jurusanId = Jurusan::where('nama', $request->input('jurusan'))->value('id');
            $query->where('jurusan_id', $jurusanId);
        }

        //ambil semua kelas dan urutkan berdasarkan nama jurusan
        $kelas = $query->with('jurusan')->orderBy('jurusan_id')->get();
        $jurusan = Jurusan::all();

        return view('admin.kelas.kelas_index', compact('kelas', 'jurusan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.kelas.kelas_create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan_id' => 'required',
        ]);
        Kelas::create($request->all());
        return redirect()->route('kelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nama)
    {
        $kelas = Kelas::where('nama', $nama)->firstOrFail();
        return view('admin.kelas.kelas_show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nama)
    {
        $kelas = Kelas::where('nama', $nama)->firstOrFail();
        return view('admin.kelas.kelas_edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nama)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan_id' => 'required',
        ]);

        $kelas = Kelas::where('nama', $nama)->firstOrFail();
        $kelas->update($request->all());

        return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nama)
    {
        $kelas = Kelas::where('nama', $nama)->firstOrFail();
        $kelas->delete();
        return redirect()->route('kelas.index');
    }
}
