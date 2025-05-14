@extends('layout.siswa')

@section('content')
    <h2>Selamat Datang di Dashboard Siswa</h2>

    <h4 class="mt-4">Daftar Kehadiran</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiran as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="mt-4">Pengumuman Terbaru</h4>
    @foreach ($pengumuman as $p)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $p->judul }}</strong>
                <span class="float-end text-muted">{{ $p->tanggal }}</span>
            </div>
            <div class="card-body">
                {{ $p->isi }}
            </div>
        </div>
    @endforeach
@endsection