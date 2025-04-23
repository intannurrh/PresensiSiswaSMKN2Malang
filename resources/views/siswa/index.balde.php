@extends('layouts.app') <!-- Ganti dengan layout kamu -->

@section('content')
<div class="container">
    <h2>Data Siswa</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataSiswa as $index => $siswa)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>
                    <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
