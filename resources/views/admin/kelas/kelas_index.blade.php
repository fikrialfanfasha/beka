@extends('layouts.apps')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Data Kelas</h1>
    <form action="{{ route('kelas.index') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="jurusan">Pilih Jurusan:</label>
            <select name="jurusan" id="jurusan" class="form-control">
                <option value="">Semua Jurusan</option>
                @foreach ($jurusan as $j)
                    <option value="{{ $j->nama }}" {{ request()->input('jurusan') == $j->nama ? 'selected' : '' }}>
                        {{ $j->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
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
                        <a href="{{ route('kelas.edit', $kel->nama) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('kelas.destroy', $kel->nama) }}" method="POST" class="d-inline">
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
</div>
@endsection
