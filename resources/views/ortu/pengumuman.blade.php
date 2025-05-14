@extends('layout.ortu')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-10">📢 Daftar Pengumuman Sekolah</h1>

        @if($pengumuman->isEmpty())
            <div class="text-center text-gray-500">Belum ada pengumuman yang tersedia.</div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pengumuman as $item)
                    <div class="bg-white shadow-lg rounded-xl p-6 border border-blue-100 hover:shadow-xl transition">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $item->judul }}</h2>
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <hr class="mb-3 border-gray-200">
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $item->isi }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection