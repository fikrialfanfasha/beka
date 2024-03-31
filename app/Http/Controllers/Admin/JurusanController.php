<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.jurusan_index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurusan.jurusan_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Jurusan::create($request->all());
        return redirect()->route('jurusan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nama)
    {
        $jurusan = Jurusan::where('nama', $nama)->firstOrFail();
        return view('admin.jurusan.jurusan_show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nama)
    {
        $jurusan = Jurusan::where('nama', $nama)->firstOrFail();
        return view('admin.jurusan.jurusan_edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nama)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $jurusan = Jurusan::where('nama', $nama)->firstOrFail();
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nama)
    {
        $jurusan = Jurusan::where('nama', $nama)->firstOrFail();
        $jurusan->delete();
        return redirect()->route('jurusan.index');
    }
}
