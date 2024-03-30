@extends('layouts.apps')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Data Kelas</h1>
    <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-4">Tambah Kelas</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Jurusan</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kelas as $kel)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kel->nama }}</td>
                    <td>{{ $kel->jurusan->nama }}</td>
                    <td>
                        <a href="{{ route('kelas.edit', $kel->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('kelas.destroy', $kel->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data kelas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection