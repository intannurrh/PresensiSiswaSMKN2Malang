@extends('layout.guru')

@section('content')

<section class="laporan-section" id="laporan">
    <h2>Daftar Kehadiran Siswa (Laporan)</h2>
    <div class="filter-controls">
        <label for="filter-date">Filter Tanggal:</label>
        <input type="date" id="filter-date">
        <input type="text" id="search-input" placeholder="Cari nama siswa...">
        <button class="download-btn" onclick="downloadCSV()">Download Rekapan</button>
    </div>
    <table id="attendance-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        </tbody>
        <tbody id="attendance-body">
            <!-- Data kehadiran akan ditampilkan di sini -->
        </tbody>

    </table>
</section>

@endsection
