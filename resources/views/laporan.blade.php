@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <section class="laporan-section" id="laporan">
        <div class="laporan-container">
            <h2>Daftar Kehadiran Siswa (Laporan)</h2>
            <div class="filter-bar">
                <input type="date" id="filterTanggal" />
                <input type="text" placeholder="Cari nama siswa..." id="cariNama" />
                <button id="downloadBtn">Download Rekapan</button>
            </div>

            <table class="tabel-laporan">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Kehadiran dinamis dari controller -->
                </tbody>
            </table>
        </div>

    </section>
@endsection