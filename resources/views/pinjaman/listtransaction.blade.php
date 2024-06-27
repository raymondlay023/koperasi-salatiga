<x-app-layout>
    @section('content')


        <style>
            .no-data {
                text-align: center;
                color: #ff4d4d;
                font-size: 1.2em;
            }

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
            }

            .styled-table thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
            }

            .styled-table th,
            .styled-table td {
                padding: 12px 15px;
            }

            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
            }

            .styled-table tbody tr:hover {
                background-color: #f1f1f1;
                cursor: pointer;
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
        <a href="{{ route('pinjaman.index') }}" class="btn btn-primary"> Back to Index</a>
        @if ($datas->isEmpty())
            <p class="no-data">No transaction available.</p>
        @else
            <div class="table-wrapper">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Deskripsi Tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->Pinjamanlist->memberpinjaman->nama_anggota }}</td>
                                <td>{{ $data->bayar }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->remark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endsection
</x-app-layout>
