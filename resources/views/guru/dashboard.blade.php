@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="dashboard-section active-section">
  <h2>Laporan Terkini</h2>

  <div class="laporan-cards">
    <div class="laporan-card hadir">
      <i class="fas fa-user-check"></i>
      <p>{{ $hadir }} Siswa Hadir</p>
    </div>
    <div class="laporan-card tidak-hadir">
      <i class="fas fa-user-times"></i>
      <p>{{ $tidakHadir }} Siswa Tidak Hadir</p>
    </div>
    <div class="laporan-card telat">
      <i class="fas fa-user-clock"></i>
      <p>{{ $terlambat }} Siswa Terlambat</p>
    </div>
  </div>

  <h3>Daftar Kehadiran Siswa <input type="text" placeholder="Cari nama siswa..."></h3>
  <table>
    <thead>
      <tr>
        <th>Nama Siswa</th>
        <th>Status</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($presensi as $p)
      <tr>
        <td>{{ $p->nama }}</td>
        <td>{{ $p->status }}</td>
        <td>{{ $p->tanggal }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection
