@extends('layout.ortu')

@section('content')
    <section class="dashboard-wrapper">
        <h1 class="dashboard-title">Dashboard Orang Tua</h1>

        <section class="cards">
            <div class="card">
                <i class="fas fa-user-clock"></i>
                <h2>Presensi Harian</h2>
                <p>Lihat jam masuk dan pulang anak Anda setiap hari</p>
            </div>
            <div class="card">
                <i class="fas fa-bullhorn"></i>
                <h2>Pengumuman</h2>
                <p>Informasi terbaru dan pengumuman dari sekolah</p>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h2>Laporan Kehadiran</h2>
                <p>Statistik kehadiran harian dan bulanan anak</p>
            </div>
        </section>

        <div class="rekap-button">
            <a href="#">Lihat Rekapan Bulanan</a>
        </div>
    </section>
@endsection