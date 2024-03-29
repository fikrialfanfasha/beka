<!-- File: resources/views/absen/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Form Absensi Siswa</h1>
    <form action="{{ route('absen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="tanggal">Tanggal Absen:</label>
                <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" readonly>
            </div>
            <label for="jurusan_id">Pilih Jurusan:</label>
            <select class="form-control" name="jurusan_id" id="jurusan_id">
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kelas_id">Pilih Kelas:</label>
            <select class="form-control" name="kelas_id" id="kelas_id" disabled>
                <option value="">Pilih Kelas</option>
            </select>
        </div>
        <div id="siswa-list" class="mb-4"></div>
        
        <button type="submit" class="btn btn-primary">Simpan Absen</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#jurusan_id').change(function () {
            var jurusanId = $(this).val();
            if (jurusanId) {
                $('#kelas_id').prop('disabled', false);
                $('#kelas_id').empty();
                $('#siswa-list').empty();
                $('#kelas_id').append('<option value="">Pilih Kelas</option>');
                $.ajax({
                    url: '/kelas/' + jurusanId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#kelas_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#kelas_id').prop('disabled', true);
                $('#kelas_id').empty();
                $('#siswa-list').empty();
            }
        });

        $('#kelas_id').change(function () {
            var kelasId = $(this).val();
            if (kelasId) {
                $('#siswa-list').empty();
                $.ajax({
                    url: '/siswa/' + kelasId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#siswa-list').append('<table class="table"><thead><tr><th>Nama Siswa</th><th>Status Absen</th></tr></thead><tbody>');
                        $.each(data, function (key, value) {
                            $('#siswa-list').append('<tr><td>' + value + '</td><td><select class="form-control" name="status_absen[' + key + ']"><option value="hadir">Hadir</option><option value="sakit">Sakit</option><option value="izin">Izin</option><option value="alfa">Alfa</option></select></td></tr>');
                        });
                        $('#siswa-list').append('</tbody></table>');
                    }
                });
            } else {
                $('#siswa-list').empty();
            }
        });
    });
</script>
@endsection
