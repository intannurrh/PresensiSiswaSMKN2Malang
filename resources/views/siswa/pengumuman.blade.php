@extends('layout.siswa')

@section('content')
    <h3>Pengumuman</h3>
    @foreach ($pengumuman as $p)
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <strong>{{ $p->judul }}</strong>
                <span class="float-end">{{ $p->tanggal }}</span>
            </div>
            <div class="card-body">
                {{ $p->isi }}
            </div>
        </div>
    @endforeach
@endsection