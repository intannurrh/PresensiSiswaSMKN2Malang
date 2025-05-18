@extends('layout.guru')

@section('title', 'Laporan Kehadiran')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4 text-primary">
                        <i class="bi bi-journal-check me-2"></i>Laporan Kehadiran Siswa
                    </h4>

                    <!-- Filter dan Pencarian -->
                    <form class="row g-3 mb-4 align-items-end">
                        <div class="col-md-4">
                            <label for="filter-date" class="form-label fw-semibold">Filter Tanggal</label>
                            <input type="date" id="filter-date" class="form-control" onchange="filterByDate()">
                        </div>
                        <div class="col-md-5">
                            <label for="search-input" class="form-label fw-semibold">Cari Nama</label>
                            <input type="text" id="search-input" class="form-control" placeholder="Cari nama siswa..."
                                onkeyup="filterByName()">
                        </div>
                        <div class="col-md-3 d-flex justify-content-end">
                            <a href="{{ route('guru.downloadLaporan') }}" id="download-link"
                                class="btn btn-outline-primary w-100">
                                <i class="fas fa-download me-1"></i> Download Rekapan
                            </a>
                        </div>
                    </form>

                    <!-- Tabel Kehadiran -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0" id="attendance-table">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th style="width:30%;">Nama Siswa</th>
                                    <th style="width:15%;">Status</th>
                                    <th style="width:15%;">Tanggal</th>
                                    <th style="width:15%;">Waktu</th>
                                    <th style="width:20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-body">
                                @forelse ($presensis as $index => $presensi)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="student-name">{{ $presensi->siswa->nama_siswa ?? 'Tidak diketahui' }}</td>
                                        <td class="text-center">{{ $presensi->status }}</td>
                                        <td class="attendance-date text-center">{{ $presensi->tanggal }}</td>
                                        <td class="text-center">{{ $presensi->jam ?? '-' }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('guru.destroy', $presensi->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Tidak ada data kehadiran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Filter & Download -->
    <script>
        document.getElementById('filter-date').addEventListener('change', function () {
            const date = this.value;
            const downloadLink = document.getElementById('download-link');
            const url = new URL("{{ route('guru.downloadLaporan') }}", window.location.origin);

            if (date) {
                url.searchParams.set('tanggal', date);
            } else {
                url.searchParams.delete('tanggal');
            }

            downloadLink.href = url.toString();
        });

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
    </script>
@endsection