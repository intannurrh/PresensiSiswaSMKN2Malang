@extends('layout.ortu')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* Ganti warna hijau jadi biru (kecuali grafik) */
        .text-success {
            color: #0d6efd !important; /* warna biru */
        }
        .btn-success {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .bi-calendar-check.text-success {
            color: #0d6efd !important; /* icon kalender biru */
        }
        .card.shadow-sm {
            background-color: #f9fafd; /* card bg sedikit beda */
        }
        .pengumuman-badge {
            background-color: #0d6efd;
            color: white;
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: 6px;
        }
        .btn-presensi {
            display: inline-block;
            margin-top: 1rem;
            background-color: #0d6efd;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-presensi:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 text-center mb-4">
            <p class="text-muted">Terima kasih sudah mendampingi putra-putri Anda belajar dengan penuh semangat.</p>
            <a href="{{ url('/ortu/presensi') }}" class="btn-presensi">Presensi Siswa
            </a>
        </div>

        <!-- Rekap Kehadiran -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-calendar-check text-success" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-2">Data Kehadiran Harian</h5>
                    </div>

                    <hr>

                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($presensis as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->date)->format('d-m-Y') }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Tidak ada data kehadiran.</td>
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
                            <span class="pengumuman-badge">Orang Tua</span>
                        </h5>
                    </div>

                    <hr>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Ujian Tengah Semester dimulai 20 Mei 2025</li>
                        <li class="list-group-item">Harap mengumpulkan tugas Bahasa Indonesia paling lambat 18 Mei</li>
                        <li class="list-group-item">Libur Hari Raya: 5–10 Juni 2025</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const attendanceData = @json($presensis);

        function calculateStats() {
            const stats = { Hadir: 0, Terlambat: 0, Izin: 0, 'Tidak Hadir': 0 };
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
                        label: 'Jumlah Kehadiran',
                        data: [stats['Hadir'], stats['Terlambat'], stats['Izin'], stats['Tidak Hadir']],
                        backgroundColor: ['#28a745', '#ffc107', '#fd7e14', '#dc3545'] // grafik tetap hijau dsb
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map((label, index) => ({
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index]
                                    }));
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
