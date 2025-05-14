@extends('layout.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="row g-4">
        <!-- Rekap Kehadiran -->
        <div class="col-lg-8">
            <div class="card p-4">
                <h4 class="text-primary mb-4">Data Kehadiran Harian</h4>

                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceTableBody">
                        <!-- Data diisi lewat JS -->
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h5 class="mb-0">Rekap Kehadiran</h5>
                    <button class="btn btn-success btn-sm" onclick="downloadRekap()">Download Rekap</button>
                </div>

                <div class="mt-3">
                    <canvas id="attendanceChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="col-lg-4">
            <div class="card p-4">
                <h5 class="text-warning mb-3">📢 Pengumuman</h5>
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
    <script>
        const attendanceData = [
            { date: '2025-04-01', status: 'Hadir' },
            { date: '2025-04-02', status: 'Tidak Hadir' },
            { date: '2025-04-03', status: 'Hadir' },
            { date: '2025-04-04', status: 'Hadir' },
            { date: '2025-04-05', status: 'Sakit' }
        ];

        function populateAttendanceTable() {
            const tableBody = document.getElementById('attendanceTableBody');
            attendanceData.forEach(data => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${data.date}</td><td>${data.status}</td>`;
                tableBody.appendChild(row);
            });
        }

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

        function downloadRekap() {
            let csv = "Tanggal,Status Kehadiran\n";
            attendanceData.forEach(item => {
                csv += `${item.date},${item.status}\n`;
            });

            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "rekap_kehadiran.csv";
            a.click();
            window.URL.revokeObjectURL(url);
        }

        populateAttendanceTable();
        renderChart();
    </script>
@endsection