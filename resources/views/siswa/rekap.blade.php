@extends('layout.ortu')

@section('title', 'Rekap Kehadiran')

@section('content')
    <div class="container">
        <h2>Data Kehadiran Harian</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Status Kehadiran</th>
                </tr>
            </thead>
            <tbody id="attendanceTableBody">
                {{-- Data akan diisi oleh JavaScript --}}
            </tbody>
        </table>

        <h3>Rekap Grafik Kehadiran</h3>
        <div class="chart-container">
            <canvas id="attendanceChart"></canvas>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Gaya seperti sebelumnya */
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        h2,
        h3 {
            text-align: center;
            color: #4facfe;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th,
        td {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f0f8ff;
        }

        td.status-hadir {
            background-color: #d4edda;
            color: #155724;
        }

        td.status-izin {
            background-color: #fff3cd;
            color: #856404;
        }

        td.status-sakit {
            background-color: #ffe5b4;
            color: #8a6d3b;
        }

        td.status-alpa {
            background-color: #f8d7da;
            color: #721c24;
        }

        .chart-container {
            margin-top: 1.5rem;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const attendanceData = @json($rekapKehadiran); // Data dari controller

        function getStatusClass(status) {
            switch (status) {
                case 'Hadir': return 'status-hadir';
                case 'Izin': return 'status-izin';
                case 'Sakit': return 'status-sakit';
                case 'Tidak Hadir': return 'status-alpa';
                default: return '';
            }
        }

        function populateAttendanceTable() {
            const tbody = document.getElementById('attendanceTableBody');
            attendanceData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                                                                        <td>${item.date}</td>
                                                                        <td class="${getStatusClass(item.status)}">${item.status}</td>
                                                                      `;
                tbody.appendChild(row);
            });
        }

        function calculateAttendanceStats() {
            const stats = { hadir: 0, izin: 0, sakit: 0, alpa: 0 };
            attendanceData.forEach(item => {
                if (item.status === 'Hadir') stats.hadir++;
                if (item.status === 'Izin') stats.izin++;
                if (item.status === 'Sakit') stats.sakit++;
                if (item.status === 'Tidak Hadir') stats.alpa++;
            });
            return stats;
        }

        function renderAttendanceChart() {
            const stats = calculateAttendanceStats();
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
                    datasets: [{
                        label: 'Jumlah Kehadiran',
                        data: [stats.hadir, stats.izin, stats.sakit, stats.alpa],
                        backgroundColor: ['#28a745', '#ffc107', '#fd7e14', '#dc3545'],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 1500,
                        easing: 'easeOutBounce'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        populateAttendanceTable();
        renderAttendanceChart();
    </script>
@endsection