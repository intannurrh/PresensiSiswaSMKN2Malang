@extends('layout.guru')

@section('title', 'Profil')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle text-primary" style="font-size: 4rem;"></i>
                        <h5 class="mt-2">Informasi Profil</h5>
                        <p class="text-muted mb-0">Detail akun guru</p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIP</label>
                        <input type="text" class="form-control bg-light" value="{{ $guru->nip ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control bg-light" value="{{ $guru->nama ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelas yang Diampu</label>
                        <input type="text" class="form-control bg-light" value="{{ $guru->kelas ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jurusan</label>
                        <input type="text" class="form-control bg-light" value="{{ $guru->jurusan ?? '-' }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection