@extends('layout.siswa')

@section('title', 'Profil')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle text-primary" style="font-size: 4rem;"></i>
                        <h5 class="mt-2">Informasi Profil</h5>
                        <p class="text-muted mb-0">Detail akun siswa</p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIS</label>
                        <input type="text" class="form-control bg-light" value="{{ $siswa->nis ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light" value="{{ $siswa->nama_siswa ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Orang Tua</label>
                        <input type="text" class="form-control bg-light"
                            value="{{ $siswa->orangTua->nama_orangtua ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Wali Kelas</label>
                        <input type="text" class="form-control bg-light" value="{{ $siswa->guru->nama ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelas</label>
                        <input type="text" class="form-control bg-light" value="{{ $siswa->kelas ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jurusan</label>
                        <input type="text" class="form-control bg-light" value="{{ $siswa->jurusan ?? '-' }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection