@extends('layout.guru')

@section('title', 'Laporan Kehadiran')

@section('content')
    <div class="container mb-4">
        <h4 class="mb-4">Laporan Kehadiran Siswa</h4>

        <!-- Filter dan Pencarian -->
        <div class="row mb-3 g-2 align-items-end">
            <div class="col-md-3">
                <label for="filter-date" class="form-label">Filter Tanggal:</label>
                <input type="date" id="filter-date" class="form-control" onchange="filterByDate()">
            </div>
            <div class="col-md-4">
                <label for="search-input" class="form-label">Cari Nama:</label>
                <input type="text" id="search-input" class="form-control" placeholder="Cari nama siswa..."
                    onkeyup="filterByName()">
            </div>
            <div class="col-md-3 mt-2">
                <button class="btn btn-outline-primary mt-4" onclick="downloadCSV()">
                    <i class="fas fa-download me-1"></i> Download Rekapan
                </button>
            </div>
        </div>

        <!-- Tabel Kehadiran -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover mb-0" id="attendance-table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="attendance-body">
                        @forelse ($presensis as $index => $presensi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="student-name">{{ $presensi->siswa->nama ?? 'Tidak diketahui' }}</td>
                                <td>{{ $presensi->status }}</td>
                                <td class="attendance-date">{{ $presensi->tanggal }}</td>
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
                                <td colspan="6" class="text-center">Tidak ada data kehadiran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Filter & Download -->
    <script>
        function filterByName() {
            const input = document.getElementById("search-input").value.toLowerCase();
            const rows = document.querySelectorAll("#attendance-body tr");

            rows.forEach(row => {
                const name = row.querySelector(".student-name").textContent.toLowerCase();
                row.style.display = name.includes(input) ? "" : "none";
            });
        }

        function filterByDate() {
            const inputDate = document.getElementById("filter-date").value;
            const rows = document.querySelectorAll("#attendance-body tr");

            rows.forEach(row => {
                const rowDate = row.querySelector(".attendance-date").textContent;
                row.style.display = inputDate === "" || rowDate === inputDate ? "" : "none";
            });
        }

        function downloadCSV() {
            let csv = ['No,Nama,Status,Tanggal,Jam'];
            const rows = document.querySelectorAll("#attendance-body tr");

            rows.forEach((row, index) => {
                if (row.style.display !== "none") {
                    const cols = row.querySelectorAll("td");
                    let data = [
                        index + 1,
                        cols[1].textContent.trim(),
                        cols[2].textContent.trim(),
                        cols[3].textContent.trim(),
                        cols[4].textContent.trim()
                    ];
                    csv.push(data.join(","));
                }
            });

            const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'rekapan_kehadiran.csv';
            a.click();
        }
    </script>
@endsection