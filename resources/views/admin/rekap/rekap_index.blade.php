@extends('layouts.apps')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Rekap Absen Per Kelas</h1>

    <!-- Form filter kelas -->
    <form action="{{ route('rekap.index') }}" method="GET" class="mb-4" id="filterForm">
        <div class="form-group">
            <label for="kelas">Pilih Kelas:</label>
            <select name="kelas" id="kelas" class="form-control">
                <option value="">Semua Kelas</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->nama }}" {{ request('kelas') == $item->nama ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Daftar siswa berdasarkan kelas -->
    @if ($daftarSiswa)
        <div class="mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Hadir</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alfa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarSiswa as $siswa)
                        <tr>
                            <td>{{ $siswa->nis}}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas->nama }}</td>
                            <td>{{ $siswa->absensi->where('status', 'hadir')->count() }}</td>
                            <td>{{ $siswa->absensi->where('status', 'sakit')->count() }}</td>
                            <td>{{ $siswa->absensi->where('status', 'izin')->count() }}</td>
                            <td>
                                @if ($siswa->absensi->where('status', 'alfa')->count() >= 3)
                                    <span class="badge bg-danger">{{ $siswa->absensi->where('status', 'alfa')->count() }}</span>
                                @else
                                    {{ $siswa->absensi->where('status', 'alfa')->count() }}
                                @endif
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="3">Tidak ada data rekap.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
