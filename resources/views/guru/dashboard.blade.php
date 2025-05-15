@extends('layout.guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="container-fluid px-4">
        <h4 class="mb-4">Laporan Kehadiran Hari Ini</h4>

        @php
            $hadir = $presensis->where('status', 'Hadir')->count();
            $tidakHadir = $presensis->where('status', 'Tidak Hadir')->count();
            $terlambat = $presensis->where('status', 'Terlambat')->count();
        @endphp

        <!-- Kartu Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-md-4 col-sm-6">
                <div class="card card-border-left hadir shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-check fa-2x text-success me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Hadir</h5>
                            <p class="card-text">{{ $hadir }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card card-border-left tidak-hadir shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-times fa-2x text-danger me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Tidak Hadir</h5>
                            <p class="card-text">{{ $tidakHadir }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card card-border-left telat shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-clock fa-2x text-warning me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Terlambat</h5>
                            <p class="card-text">{{ $terlambat }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Kehadiran -->
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Laporan Kehadiran Hari Ini</h5>
                <a href="{{ route('guru.downloadCSV') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download"></i> Unduh CSV
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presensis as $presensi)
                                <tr>
                                    <td>{{ $presensi->siswa->nama ?? 'Tidak diketahui' }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $presensi->status == 'Hadir' ? 'success' : ($presensi->status == 'Terlambat' ? 'warning' : 'danger') }}">
                                            {{ $presensi->status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $presensi->jam ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('guru.destroy', $presensi->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Tidak ada data kehadiran hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection