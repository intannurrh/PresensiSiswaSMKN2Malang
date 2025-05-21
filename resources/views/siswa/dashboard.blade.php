@extends('layout.siswa')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-12 text-center mb-4">
        <h4 class="fw-bold text-primary">Selamat Datang, {{ $siswa->nama_siswa ?? '-' }}!</h4>
        <p class="text-muted">Semoga harimu menyenangkan dan penuh semangat belajar.</p>
    </div>
    <!-- Tombol Presensi -->
    <div class="col-12 text-center mb-4">
        <a href="{{ route('siswa.presensi') }}"
            class="btn btn-primary btn-lg rounded-pill shadow d-inline-flex align-items-center px-4 py-2">
            <i class="bi bi-pencil-square me-2 fs-5"></i>
            Isi Presensi Hari Ini
        </a>
    </div>

    <!-- Rekap Kehadiran -->
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="bi bi-calendar-check text-primary" style="font-size: 2.5rem;"></i>
                    <h5 class="mt-2">Data Kehadiran Harian</h5>
                </div>

                <hr>

                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Jam Kehadiran</th>
                            <th>Jam Pulang</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presensis as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                            <td>
                                {{ $item->jam_pulang ? \Carbon\Carbon::parse($item->jam_pulang)->format('H:i') : '-' }}
                            </td>
                            <td class="text-center">
                                @if ($item->status)
                                <span class="badge bg-{{ 
                                    $item->status == 'Hadir' ? 'success' : 
                                    ($item->status == 'Terlambat' ? 'warning' : 
                                    ($item->status == 'Izin' ? 'info' : 'danger')) 
                                }}">
                                    {{ $item->status}}
                                </span>
                                @else
                                <span class="badge bg-secondary">Belum Hadir</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Tidak ada data kehadiran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    <canvas id="attendanceChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengumuman -->
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-center mb-3">
                    <span style="font-size: 2.5rem;">📢</span>
                    <h5 class="mt-2">
                        Pengumuman
                        <span class="pengumuman-badge">Siswa</span>
                    </h5>
                </div>

                <hr>

                <ul class="list-group list-group-flush">
                    @forelse($pengumuman as $item)
                    <li class="list-group-item text-start">
                        <button
                            type="button"
                            class="btn btn-link text-decoration-none text-start w-100 d-flex justify-content-between align-items-center"
                            data-bs-toggle="modal"
                            data-bs-target="#modal1{{ $item->id_pengumuman }}"
                            style="color: #333;">
                            <span>{{ $item->judul }}</span>
                            <span class="text-muted"><i class="fas fa-arrow-right"></i></span> <!-- Panah kanan -->
                        </button>

                    </li>

                    <!-- Modal per item -->
                    <div class="modal fade" id="modal1{{ $item->id_pengumuman }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id_pengumuman }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $item->id_pengumuman }}">{{ $item->judul }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->isi }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <li class="list-group-item">Belum ada pengumuman.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const attendanceData = @json($presensis);

        function calculateStats() {
            const stats = {
                Hadir: 0,
                Terlambat: 0,
                Izin: 0,
                'Tidak Hadir': 0
            };
            attendanceData.forEach(data => {
                if (stats[data.status] !== undefined) stats[data.status]++;
            });
            return stats;
        }

        function renderChart() {
            const stats = calculateStats();
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Hadir', 'Terlambat', 'Izin', 'Tidak Hadir'],
                    datasets: [{
                        label: ['Hadir', 'Terlambat', 'Izin', 'Tidak Hadir'],
                        data: [stats['Hadir'], stats['Terlambat'], stats['Izin'], stats['Tidak Hadir']],
                        backgroundColor: ['#28a745', '#ffc107', '#0dcaf0', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map((label, index) => {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[index]
                                        };
                                    });
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        renderChart();
    </script>
    @endsection