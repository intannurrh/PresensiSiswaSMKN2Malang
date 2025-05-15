@extends('layout.guru')

@section('content')

    <section class="data-siswa-section" id="data-siswa">
        <h2 class="mb-4">Data Siswa</h2>
        <div class="table-responsive">
            <table class="table table-striped" id="data-siswa-table">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>
                                <!-- Tambahkan aksi jika ada -->
                                <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i> Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada siswa yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection