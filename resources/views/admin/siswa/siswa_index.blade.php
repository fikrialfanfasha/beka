@extends('layouts.apps')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Data Siswa</h1>
    <form action="{{ route('siswa.index') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="kelas">Pilih Kelas:</label>
            <select name="kelas" id="kelas" class="form-control">
                <option value="">Semua Kelas</option>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls->nama }}" {{ request()->input('kelas') == $kls->nama ? 'selected' : '' }}>
                        {{ $kls->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-4">Tambah Siswa</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $sw)
                <tr>
                    <td>{{ $sw->nis }}</td>
                    <td>{{ $sw->nama }}</td>
                    <td>{{ $sw->kelas['nama'] }}</td>
                    <td>{{ $sw->kelas['jurusan']['nama'] }}</td>
                    <td>
                        <a href="{{ route('siswa.edit', $sw->nis) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('siswa.destroy', $sw->nis) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
