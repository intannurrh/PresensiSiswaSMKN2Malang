@extends('layout.guru')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h4 class="mb-4 text-primary">
        <i class="bi bi-speedometer2 me-2"></i>Laporan Kehadiran - {{ now()->format('d M Y') }}
    </h4>

    @php
    $hadir = $siswaList->filter(fn($s) => optional($s->presensi_today)->status === 'Hadir')->count();
    $terlambat = $siswaList->filter(fn($s) => optional($s->presensi_today)->status === 'Terlambat')->count();
    $izin = $siswaList->filter(fn($s) => optional($s->presensi_today)->status === 'Izin')->count();

    // Yang belum presensi akan dianggap Tidak Hadir
    $tidakHadir = $siswaList->filter(fn($s) => !$s->presensi_today || $s->presensi_today->status === 'Tidak Hadir')->count();
    @endphp


    <!-- Kartu Statistik -->
    <div class="row g-4 mb-4">
        @foreach ([['Hadir', 'success', $hadir], ['Terlambat', 'warning', $terlambat], ['Izin', 'info', $izin], ['Tidak Hadir', 'danger', $tidakHadir]] as [$label, $color, $count])
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-start border-4 border-{{ $color }}">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user-{{ $label == 'Hadir' ? 'check' : ($label == 'Tidak Hadir' ? 'times' : 'clock') }} fa-2x text-{{ $color }} me-3"></i>
                    <div>
                        <h5 class="mb-1 fw-semibold">{{ $label }}</h5>
                        <p class="mb-0 text-muted">{{ $count }} Siswa</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                            <th>Jam Kehadiran</th>
                            <th>Jam Pulang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswaList as $siswa)
                        <tr>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td class="text-center">
                                @if ($siswa->presensi_today)
                                <span class="badge bg-{{ 
                $siswa->presensi_today->status == 'Hadir' ? 'success' : 
                ($siswa->presensi_today->status == 'Terlambat' ? 'warning' : 
                ($siswa->presensi_today->status == 'Izin' ? 'info' : 'danger')) 
            }}">
                                    {{ $siswa->presensi_today->status }}
                                </span>
                                @else
                                <span class="badge bg-secondary">Belum Hadir</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $siswa->presensi_today ? \Carbon\Carbon::parse($siswa->presensi_today->tanggal)->format('d M Y') : '-' }}
                            </td>
                            <td class="text-center">
                                {{ $siswa->presensi_today ? \Carbon\Carbon::parse($siswa->presensi_today->created_at)->format('H:i:s') : '-' }}
                            </td>
                            <td class="text-center">
                                {{ $siswa->presensi_today->jam_pulang ?? '-' }}
                            </td>
                            <td class="text-center">
                                {{ $siswa->presensi_today->keterangan ?? '-' }}
                            </td>
                            <td class="text-center">
                                @if ($siswa->presensi_today)
                                <form action="{{ route('guru.destroy', $siswa->presensi_today->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Tidak ada data siswa.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection