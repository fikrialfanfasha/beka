@extends('layouts.apps')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Data Jurusan </h1>
    <a href="{{ route('jurusan.create') }}" class="btn btn-primary mb-4">Tambah Jurusan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurusan as $jur)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jur->nama }}</td>
                    <td>
                        <a href="{{ route('jurusan.edit', $jur->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('jurusan.destroy', $jur->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data jurusan.</td>
                </tr>
            @endforelse
        </tbody>
@endsection