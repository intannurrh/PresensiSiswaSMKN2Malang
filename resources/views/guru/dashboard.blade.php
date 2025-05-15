@extends('layout.guru')

@section('title', 'Dashboard')

@section('content')
    <h4 class="mb-4">Laporan Kehadiran Hari Ini</h4>

    <div class="row g-3 mb-4">
        @php
            $hadir = $presensis->where('status', 'Hadir')->count();
            $tidakHadir = $presensis->where('status', 'Tidak Hadir')->count();
            $terlambat = $presensis->where('status', 'Terlambat')->count();
        @endphp

        <div class="col-md-4">
            <div class="card border-start border-success shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user-check fa-2x text-success me-3"></i>
                    <div>
                        <h6 class="mb-0">Hadir</h6>
                        <p class="mb-0">{{ $hadir }} Siswa</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-start border-danger shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user-times fa-2x text-danger me-3"></i>
                    <div>
                        <h6 class="mb-0">Tidak Hadir</h6>
                        <p class="mb-0">{{ $tidakHadir }} Siswa</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-start border-warning shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user-clock fa-2x text-warning me-3"></i>
                    <div>
                        <h6 class="mb-0">Terlambat</h6>
                        <p class="mb-0">{{ $terlambat }} Siswa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL KEHADIRAN -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Kehadiran</h5>
            <a href="{{ route('guru.downloadCSV') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-download"></i> Unduh CSV
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
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
                            <td>{{ $presensi->status }}</td>
                            <td>{{ $presensi->tanggal }}</td>
                            <td>{{ $presensi->jam ?? '-' }}</td>
                            <td>
                                <form action="{{ route('guru.destroy', $presensi->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data kehadiran hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection