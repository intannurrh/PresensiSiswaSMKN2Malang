@extends('layout.admin')

@section('content')

<section class="data-siswa-section" id="data-siswa">
    <h2>Data Siswa</h2>
    <table class="data-siswa-table" id="data-siswa-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="data-siswa-body">
            <!-- Data siswa akan dimasukkan di sini -->
        </tbody>
    </table>
</section>

@endsection
