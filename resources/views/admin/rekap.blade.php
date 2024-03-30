@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Data Absensi Siswa</h1>
    <form action="{{ route('admin.index') }}" method="GET">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="jurusan_id">Pilih Jurusan:</label>
                <select class="form-control" name="jurusan_id" id="jurusan_id">
                    <option value="">Pilih Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="kelas_id">Pilih Kelas:</label>
                <select class="form-control" name="kelas_id" id="kelas_id" disabled>
                    <option value="">Pilih Kelas</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Tampilkan Data</button>
            </div>
        </div>
    </form>

    <div id="siswa-list" class="mb-4"></div>
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
                $.ajax({
                    url: '/admin/data/' + kelasId,
                    type: 'GET',
                    dataType: 'html',
                    success: function (response) {
                        $('#siswa-list').html(response);
                    }
                });
            } else {
                $('#siswa-list').empty();
            }
        });
    });
</script>

@endsection
