@extends('layout.guru')

@section('title', 'Data Siswa')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 text-primary">
                                <i class="bi bi-people-fill me-2"></i>Data Siswa
                            </h5>
                            <small class="text-muted">Daftar siswa yang berada dalam kelas Anda</small>
                        </div>
                        <a href="{{ route('guru.datasiswa') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light text-center">
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
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->jurusan }}</td>
                                        <td>{{ $item->orangTua->nama_orangtua ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Tidak ada siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection