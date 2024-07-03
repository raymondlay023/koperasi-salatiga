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
            <span class="text-3xl font-semibold ">Laporan Tahu dan Tempe {{ $startDate }} hingga
                {{ $endDate }}</span>
        </div>

        @if (empty($result))
            <p class="text-center mb-6">No data available for the selected period.</p>
        @else
            <div class="table-wrapper">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Total Pembelian Quantity</th>
                            <th>Total Pembelian Price</th>
                            <th>Total Penjualan Quantity</th>
                            <th>Total Penjualan Price</th>
                            <th>Keuntungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPembelianQuantity = 0;
                            $totalPembelianPrice = 0;
                            $totalPenjualanQuantity = 0;
                            $totalPenjualanPrice = 0;
                        @endphp
                        @foreach ($result as $item)
                            @php
                                $totalPembelianQuantity += $item['pembelian']['totalquantity'];
                                $totalPembelianPrice += $item['pembelian']['totalprice'];
                                $totalPenjualanQuantity += $item['penjualan']['totalquantity'];
                                $totalPenjualanPrice += $item['penjualan']['totalprice'];
                            @endphp
                            <tr>
                                <td>{{ $item['category'] }}</td>
                                <td>{{ $item['pembelian']['totalquantity'] }}</td>
                                <td>Rp {{ number_format($item['pembelian']['totalprice'], 0, ',', '.') }}</td>
                                <td>{{ $item['penjualan']['totalquantity'] }}</td>
                                <td>Rp {{ number_format($item['penjualan']['totalprice'], 0, ',', '.') }}</td>
                                <td>
                                    Rp
                                    {{ number_format($item['penjualan']['totalprice'] - $item['pembelian']['totalprice'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>{{ $totalPembelianQuantity }}</strong></td>
                            <td><strong>Rp {{ number_format($totalPembelianPrice, 0, ',', '.') }}</strong></td>
                            <td><strong>{{ $totalPenjualanQuantity }}</strong></td>
                            <td><strong>Rp {{ number_format($totalPenjualanPrice, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp
                                    {{ number_format($totalPenjualanPrice - $totalPembelianPrice, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-laporan-layout>
