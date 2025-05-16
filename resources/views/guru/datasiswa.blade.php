@extends('layout.guru') {{-- Sesuaikan dengan layout guru kamu --}}
@section('title', 'Data Siswa')

@section('content')
    <div class="container">
        <a href="{{ route('guru.datasiswa') }}">Data Siswa</a>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Nama Ortu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswa as $item)
                    <tr>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->jurusan }}</td>
                        <td>{{ $item->orangTua->nama ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada siswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection