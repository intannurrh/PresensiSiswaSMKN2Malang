@extends('layout.siswa')

@section('title', 'Profil Siswa')

@section('content')
    <div class="container mt-4">
        <h2>Profil Siswa</h2>
        <table class="table table-bordered">
            <tr>
                <th>NIS</th>
                <td>{{ $siswa->nis ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $siswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Orang Tua</th>
                <td>{{ $siswa->orangTua->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Wali Kelas</th>
                <td>{{ $siswa->guru->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $siswa->kelas ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>{{ $siswa->jurusan ?? '-' }}</td>
            </tr>


        </table>
    </div>
@endsection