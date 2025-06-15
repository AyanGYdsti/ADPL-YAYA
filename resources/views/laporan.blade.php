@extends('layouts.jelajah')

@section('title', 'Laporan')

@section('content')
    <style>
        .dashboard {
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }

        .stats {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 150px;
        }

        .card h2 {
            margin: 0;
            font-size: 32px;
            color: #2c948a;
        }

        .card p {
            margin: 5px 0 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
        }

        .status-pending {
            background-color: #ffe08a;
            color: #664d03;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 13px;
            display: inline-block;
        }

        .status-selesai {
            background-color: #b7f4c9;
            color: #116c37;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 13px;
            display: inline-block;
        }

        .aksi button {
            padding: 5px 10px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-hapus {
            background-color: #e74c3c;
            color: white;
        }

        .btn-aksi {
            background-color: #bdc3c7;
            color: #2c3e50;
        }

        @media (max-width: 600px) {
            .stats {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>

    <div class="dashboard">
        <h2 style="text-align:center; margin-bottom: 20px;">Laporan admin</h2>
        <div class="stats">
            <div class="card">
                <h2>{{ $laporans->count() }}</h2>
                <p>Total Laporan</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Pelapor</th>
                    <th>Alasan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $laporan)
                    <tr>
                        <td><a href="/pesan/detail/{{ $laporan->product_id }}">{{ $laporan->product->nama }}</a></td>
                        <td>{{ $laporan->user->nama }}</td>
                        <td>{{ $laporan->alasan }}</td>
                        <td>{{ $laporan->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
