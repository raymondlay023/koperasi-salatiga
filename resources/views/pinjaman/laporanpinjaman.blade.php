<x-laporan-layout>
    <style>
        .table-wrapper {
            overflow-x: auto;
            margin: 20px auto;
            max-width: 100%;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
        }

        .styled-table thead {
            background-color: #35c7aa;
            color: #000;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .styled-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .styled-table tbody tr:last-child td {
            border-bottom: none;
        }

        .styled-table tbody td {
            vertical-align: middle;
        }

        .styled-table tfoot td {
            font-weight: bold;
            border-top: 2px solid #009879;
        }

        .table-wrapper::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        @media screen and (max-width: 600px) {
            .styled-table thead {
                display: none;
            }

            .styled-table,
            .styled-table tbody,
            .styled-table tr,
            .styled-table td {
                display: block;
                width: 100%;
            }

            .styled-table tr {
                margin-bottom: 15px;
            }

            .styled-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .styled-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
    <div class="mx-5">
        <div class="text-center mb-8 mt-6">
            <span class="text-3xl font-semibold ">Laporan Pinjaman dari {{ $startdate }} hingga
                {{ $enddate }}</span>
        </div>

        @if (empty($combinedSummary))
            <p class="text-center mb-6">No transactions available for the selected period.</p>
        @else
            <div class="table-wrapper">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Bayar</th>
                            <th>Jasa</th>
                            <th>Pokok</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Admin</th>
                            <th>Pengelola</th>
                            <th>Total Jasa Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalBayar = 0;
                            $totalPinjaman = 0;
                            $totalJasa = 0;
                            $totalPokok = 0;
                            $totalAdmin = 0;
                            $totalPengelola = 0;
                            $totalJasaPinjaman = 0;
                            $totalJasaPinjamanAkhir = 0;
                        @endphp
                        @foreach ($combinedSummary as $date => $summary)
                            @php
                                $jumlahBayar = $summary['bayar'];
                                $jumlahPinjaman = $summary['jumlah_pinjaman'];
                                $jasa = $jumlahBayar / 6;
                                $pokok = $jumlahBayar - $jasa;
                                $admin = $jumlahPinjaman * 0.05;
                                $pengelola = $jumlahPinjaman * 0.01;
                                $totalJasaPinjaman = $jasa;

                                $totalBayar += $jumlahBayar;
                                $totalPinjaman += $jumlahPinjaman;
                                $totalJasa += $jasa;
                                $totalPokok += $pokok;
                                $totalAdmin += $admin;
                                $totalPengelola += $pengelola;
                                $totalJasaPinjamanAkhir += $totalJasaPinjaman;
                            @endphp
                            <tr>
                                <td>{{ $date }}</td>
                                <td>Rp {{ number_format($jumlahBayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($jasa, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($pokok, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($jumlahPinjaman, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($admin, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($pengelola, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($totalJasaPinjaman, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>Rp {{ number_format($totalBayar, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalJasa, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalPokok, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalAdmin, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalPengelola, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalJasaPinjamanAkhir, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</x-laporan-layout>
