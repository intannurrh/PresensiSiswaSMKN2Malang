@extends('layout.ortu')

@section('title', 'Form Presensi Siswa')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<div class="container my-5" style="max-width:480px; font-family: 'Poppins', sans-serif;">
    <div class="shadow rounded-4 p-4 bg-white" style="border: 1px solid #e3e6f0;">
        <h3 class="mb-4 text-center text-primary fw-bold">Form Presensi Izin Siswa</h3>

        {{-- Alert error --}}
        @if ($errors->any())
        <div class="alert alert-danger rounded-3 py-2 px-3 mb-4" role="alert" style="font-size:0.9rem;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Alert success --}}
        @if (session('success'))
        <div class="alert alert-success rounded-3 py-2 px-3 mb-4" role="alert" style="font-size:0.95rem;">
            {{ session('success') }}
        </div>
        @endif

        @php
        $data = session('get_data');
        @endphp

        {{-- Info siswa --}}
        @if ($siswa)
        <div class="mb-4 p-3 rounded-3" style="background: #f0f5ff; border-left: 5px solid #3b82f6;">
            <p class="mb-1" style="font-weight:600;">Mengirim izin untuk:</p>
            <p class="mb-0" style="font-size: 1.1rem; font-weight:700; color:#1e40af;">{{ $siswa->nama_siswa ?? 'Nama tidak tersedia' }}</p>
            <small class="text-muted">Kelas: {{ $siswa->kelas ?? '-' }} | Jurusan: {{ $siswa->jurusan ?? '-' }}</small>
        </div>
        @endif

        <form action="{{ route('ortu.kirimPresensi') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            @php
            $today = date('Y-m-d');
            @endphp

            <div class="mb-4">
                <label for="tanggal" class="form-label fw-semibold" style="letter-spacing: 0.04em;">
                    Tanggal Izin <span class="text-danger">*</span>
                </label>
                <input
                    type="date"
                    id="tanggal"
                    name="tanggal"
                    class="form-control @error('tanggal') is-invalid @enderror"
                    value="{{ old('tanggal', $today) }}"
                    required
                    readonly
                    style="border: 1.5px solid #d1d5db; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 1rem; transition: border-color 0.3s ease; background-color: #f9fafb;"
                    onfocus="this.style.borderColor='#3b82f6';"
                    onblur="this.style.borderColor='#d1d5db';">
                @error('tanggal')
                <div class="invalid-feedback" style="font-size:0.85rem;">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="keterangan" class="form-label fw-semibold" style="letter-spacing: 0.04em;">Keterangan (Opsional)</label>
                <textarea
                    id="keterangan"
                    name="keterangan"
                    class="form-control"
                    rows="4"
                    placeholder="Contoh: Anak sedang sakit..."
                    style="border: 1.5px solid #d1d5db; border-radius: 0.5rem; padding: 0.75rem 1rem; font-size: 1rem; resize: none; transition: border-color 0.3s ease;"
                    onfocus="this.style.borderColor='#3b82f6';"
                    onblur="this.style.borderColor='#d1d5db';">{{ old('keterangan') }}</textarea>
            </div>

            <div class="mb-5">
                <label for="foto" class="form-label fw-semibold" style="letter-spacing: 0.04em;">Unggah Foto Bukti Izin <span class="text-danger">*</span></label>
                <input
                    type="file"
                    id="foto"
                    name="foto"
                    class="form-control @error('foto') is-invalid @enderror"
                    accept="image/*"
                    required
                    style="border: 1.5px solid #d1d5db; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 1rem; transition: border-color 0.3s ease;"
                    onfocus="this.style.borderColor='#3b82f6';"
                    onblur="this.style.borderColor='#d1d5db';">
                @error('foto')
                <div class="invalid-feedback" style="font-size:0.85rem;">{{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-1">Format gambar, maksimal ukuran 2MB.</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('ortu.dashboard') }}" class="btn btn-outline-primary fw-semibold px-4 py-2 rounded-3" style="flex: 1; margin-right: 0.75rem; transition: background-color 0.3s ease, color 0.3s ease;">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary fw-semibold px-4 py-2 rounded-3" style="flex: 1; transition: box-shadow 0.3s ease;">
                    Kirim Izin
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        background: #f9fafb;
    }

    .btn-primary {
        background-color: #3b82f6;
        border: none;
        box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        background-color: #2563eb;
        box-shadow: 0 8px 16px rgba(37, 99, 235, 0.4);
    }

    .btn-outline-primary {
        color: #3b82f6;
        border-color: #3b82f6;
    }

    .btn-outline-primary:hover {
        background-color: #3b82f6;
        color: white;
    }

    input.form-control:focus,
    textarea.form-control:focus {
        box-shadow: none !important;
    }

    .invalid-feedback {
        color: #dc3545 !important;
    }
</style>
@endsection