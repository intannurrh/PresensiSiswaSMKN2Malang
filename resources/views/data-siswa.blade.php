@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <section class="data-siswa-section" id="data-siswa">
        <h2>Data Siswa</h2>
        <table class="data-siswa-table" id="data-siswa-table">
            <thead>
                <tr>
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