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
                            <input type="date" id="filter-date" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="search-input" class="form-label fw-semibold">Cari Nama</label>
                            <input type="text" id="search-input" class="form-control" placeholder="Cari nama siswa...">
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
                                    <th style="width:25%;">Nama Siswa</th>
                                    <th style="width:15%;">Status</th>
                                    <th style="width:15%;">Tanggal</th>
                                    <th style="width:15%;">Waktu</th>
                                    <th style="width:25%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-body">
                                @forelse ($presensis as $index => $presensi)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="student-name">{{ $presensi->siswa->nama_siswa ?? 'Tidak diketahui' }}</td>
                                        <td class="text-center">{{ $presensi->status }}</td>
                                        <td class="attendance-date text-center">{{ $presensi->tanggal }}</td>
                                        <td class="text-center">
                                            {{ $presensi->created_at ? \Carbon\Carbon::parse($presensi->created_at)->format('H:i') : '-' }}
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Di bagian tombol edit -->
                                                <button class="btn btn-sm btn-warning me-1"
                                                    onclick="openEditModal(this, {{ $presensi->id }})" title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('guru.destroy', $presensi->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kehadiran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Siswa</label>
                            <input type="text" id="editName" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select id="editStatus" class="form-select">
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Terlambat">Terlambat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" id="editDate" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Waktu</label>
                            <input type="time" id="editTime" class="form-control">
                        </div>
                        <input type="hidden" id="editingRowIndex">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="saveEdit()">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Download link update based on filter date
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
            filterByDate();
        });

        // Filter by name
        document.getElementById('search-input').addEventListener('keyup', filterByName);

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

        let currentEditingRow = null;
        let currentEditingId = null;

        function openEditModal(button, id) {
            const row = button.closest('tr');
            currentEditingRow = row;
            currentEditingId = id;

            const name = row.querySelector('.student-name').textContent;
            const status = row.children[2].textContent.trim();
            const tanggal = row.querySelector('.attendance-date').textContent;
            const waktu = row.children[4].textContent.trim();

            document.getElementById('editName').value = name;
            document.getElementById('editStatus').value = status;
            document.getElementById('editDate').value = tanggal;
            document.getElementById('editTime').value = waktu !== '-' ? waktu : '';

            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }

        function saveEdit() {
            if (!currentEditingRow || !currentEditingId) return;

            const newStatus = document.getElementById('editStatus').value;
            const newDate = document.getElementById('editDate').value;
            const newTime = document.getElementById('editTime').value || '-';

            fetch(`/guru/kehadiran/${currentEditingId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: newStatus,
                    tanggal: newDate,
                    jam: newTime !== '-' ? newTime : null
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        location.reload(); // refresh untuk lihat perubahan
                    } else {
                        alert('Gagal menyimpan data!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection