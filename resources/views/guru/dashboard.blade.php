@extends('layout.guru')

@section('content')
<section class="dashboard-section" id="dashboard">
    <h2>Laporan Terkini</h2>

    <div class="laporan-cards">
        <div class="laporan-card hadir">
            <i class="fas fa-user-check"></i>
            <p> Siswa Hadir</p>
        </div>
        <div class="laporan-card tidak-hadir">
            <i class="fas fa-user-times"></i>
            <p> Siswa Tidak Hadir</p>
        </div>
        <div class="laporan-card telat">
            <i class="fas fa-user-clock"></i>
            <p> Siswa Terlambat</p>
        </div>
    </div>

    <h3>Daftar Kehadiran Siswa
        <input type="text" id="search-input" placeholder="Cari nama siswa...">
    </h3>
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
