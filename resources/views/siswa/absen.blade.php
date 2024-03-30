<!-- View: absen.blade.php -->

@extends('layouts.apps')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Form Absensi Siswa</h1>
    <form action="{{ route('absen.store') }}" method="POST" id="absenForm">
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

        <!-- Tombol "Simpan Absen" -->
        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Simpan Absen</button>
        <div id="alertMsg" class="alert alert-warning mt-2" style="display: none;">Anda sudah melakukan absen pada tanggal ini.</div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to check if any student already absen
        function checkAbsenStatus() {
            var duplicate = false;
            $('.status-absen').each(function() {
                var selectedValue = $(this).val();
                if (selectedValue != '') {
                    var otherSelects = $('.status-absen').not(this);
                    otherSelects.each(function() {
                        if ($(this).val() == selectedValue) {
                            duplicate = true;
                            return false; // Break the loop
                        }
                    });
                }
            });

            if (duplicate) {
                $('#submitBtn').prop('disabled', true);
                $('#alertMsg').show();
            } else {
                $('#submitBtn').prop('disabled', false);
                $('#alertMsg').hide();
            }
        }

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
                        var table = $('<table class="table"></table>');
                        var thead = $('<thead></thead>');
                        var tbody = $('<tbody></tbody>');

                        thead.append('<tr><th>Nama Siswa</th><th>Status Absen</th></tr>');
                        $.each(data, function (key, value) {
                            tbody.append('<tr><td>' + value + '</td><td><select class="form-control status-absen" name="status_absen[' + key + ']"><option value="hadir">Hadir</option><option value="sakit">Sakit</option><option value="izin">Izin</option><option value="alfa">Alfa</option></select></td></tr>');
                        });

                        table.append(thead);
                        table.append(tbody);
                        $('#siswa-list').append(table);

                        // Add event listener to select elements
                        $('.status-absen').change(function() {
                            checkAbsenStatus();
                        });
                    }
                });
            } else {
                $('#siswa-list').empty();
            }
        });

        // Call the function when the page loads
        checkAbsenStatus();

        // Add event listener to select elements
        $(document).on('change', '.status-absen', function() {
            checkAbsenStatus();
        });
    });
</script>
@endsection
