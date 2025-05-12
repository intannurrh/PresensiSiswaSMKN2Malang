@extends('layout.ortu')

@section('content')
    <h2>Rekap Presensi Anak</h2>
    <div class="card">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #e3f2fd;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Tanggal</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ortu as $data)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ $data['tanggal'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ $data['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection