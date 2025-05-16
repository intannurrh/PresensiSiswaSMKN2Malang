@extends('layout.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="row g-4">
        <!-- Rekap Kehadiran -->
        <div class="col-lg-8">
            <div class="card p-4">
                <h4 class="text-dark mb-4">Data Kehadiran Harian</h4>

                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kehadiran as $item)
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
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h5 class="mb-0">Rekap Kehadiran</h5>
                    <a href="{{ route('siswa.rekap') }}" class="btn btn-success btn-sm">Lihat Rekap Lengkap</a>
                </div>
                <div class="mt-3">
                    <canvas id="attendanceChart" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- Pengumuman -->
        <div class="col-lg-4">
            <div class="card p-4">
                <h5 class="text-dark mb-3" color=>📢 Pengumuman</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Ujian Tengah Semester dimulai 20 Mei 2025</li>
                    <li class="list-group-item">Harap mengumpulkan tugas Bahasa Indonesia paling lambat 18 Mei</li>
                    <li class="list-group-item">Libur Hari Raya: 5–10 Juni 2025</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data chart diambil dari PHP, bukan dari JS statis
        const attendanceData = @json($kehadiran);

        function calculateStats() {
            const stats = { Hadir: 0, Izin: 0, Sakit: 0, 'Tidak Hadir': 0 };
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
                    labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
                    datasets: [{
                        label: 'Jumlah Kehadiran',
                        data: [stats['Hadir'], stats['Izin'], stats['Sakit'], stats['Tidak Hadir']],
                        backgroundColor: ['#28a745', '#ffc107', '#fd7e14', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
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