@extends('layout.siswa')

@section('title', 'Presensi')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-8">
        <h3 class="mb-4 text-primary fw-bold text-center">
            <i class="bi bi-calendar-check-fill me-2"></i>Formulir Kehadiran Siswa
        </h3>

        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-body">
                {{-- Pesan sukses atau error dari controller --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    </div>
                @endif

                {{-- Menampilkan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="bi bi-x-circle-fill me-1"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Presensi Hadir --}}
                @if (!$sudahAbsen)
                    <form action="{{ route('siswa.presensi.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Status Kehadiran</label>
                            <div class="d-flex flex-wrap gap-3">
                            @foreach (['Hadir', 'Tidak Hadir', 'Terlambat'] as $option)
                                    @php
                                        $isDisabled = $option === 'Hadir' && $disableHadir;
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="{{ $option }}" value="{{ $option }}"
                                            {{ old('status') === $option ? 'checked' : '' }} {{ $isDisabled ? 'disabled' : '' }} required>
                                        <label class="form-check-label {{ $isDisabled ? 'text-muted' : '' }}" for="{{ $option }}">
                                            {{ $option }}
                                            @if ($isDisabled)
                                                <small class="text-danger d-block">(Ditutup setelah pukul 07:00)</small>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan (Opsional)</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                placeholder="Contoh: sakit perut, ada urusan keluarga, dll.">{{ old('keterangan') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-check-circle-fill me-1"></i>Submit Kehadiran
                        </button>
                    </form>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i> Kamu sudah mengisi presensi hari ini.
                    </div>

                    {{-- Tombol Pulang --}}
                    @if (is_null($presensi->jam_pulang) && $enablePulang)
                        <form action="{{ route('siswa.presensi.pulang') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-secondary">
                                <i class="bi bi-door-closed-fill me-1"></i>Presensi Pulang
                            </button>
                        </form>
                    @elseif (!is_null($presensi->jam_pulang))
                        <div class="alert alert-success mt-3">
                            <i class="bi bi-clock-fill me-2"></i> Kamu sudah melakukan presensi pulang pada {{ \Carbon\Carbon::parse($presensi->jam_pulang)->format('H:i') }}.
                        </div>
                    @else
                        <div class="alert alert-warning mt-3">
                            <i class="bi bi-clock me-2"></i> Tombol presensi pulang hanya tersedia antara pukul 14:30 - 24:00.
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div
</div>
@endsection