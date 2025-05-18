@extends('layout.guru')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid px-4 mt-4">
        <h4 class="mb-4 text-primary">
            <i class="bi bi-speedometer2 me-2"></i>Laporan Kehadiran - {{ now()->format('d M Y') }}
        </h4>

        @php
            $hadir = $presensis->where('status', 'Hadir')->count();
            $tidakHadir = $presensis->where('status', 'Tidak Hadir')->count();
            $terlambat = $presensis->where('status', 'Terlambat')->count();
        @endphp

        <!-- Kartu Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm border-start border-4 border-success">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-check fa-2x text-success me-3"></i>
                        <div>
                            <h5 class="mb-1 fw-semibold">Hadir</h5>
                            <p class="mb-0 text-muted">{{ $hadir }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm border-start border-4 border-danger">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-times fa-2x text-danger me-3"></i>
                        <div>
                            <h5 class="mb-1 fw-semibold">Tidak Hadir</h5>
                            <p class="mb-0 text-muted">{{ $tidakHadir }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm border-start border-4 border-warning">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-clock fa-2x text-warning me-3"></i>
                        <div>
                            <h5 class="mb-1 fw-semibold">Terlambat</h5>
                            <p class="mb-0 text-muted">{{ $terlambat }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Kehadiran -->
        <div class="card shadow-sm mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-center">
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
                                    <td>{{ $presensi->siswa->nama_siswa ?? 'Tidak diketahui' }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-{{ $presensi->status == 'Hadir' ? 'success' : ($presensi->status == 'Terlambat' ? 'warning' : 'danger') }}">
                                            {{ $presensi->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}</td>
                                    <td class="text-center">{{ $presensi->jam ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('guru.destroy', $presensi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
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