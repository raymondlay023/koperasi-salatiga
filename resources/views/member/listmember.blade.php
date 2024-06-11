<div class="container py-5">
    <a href="{{ route('member.index') }}">Back To Index</a>
    <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-gradient-primary text-white h4 py-3">List of Members</div>
                    <div class="card-body">
                        @if($members->isEmpty())
                            <div class="alert alert-info">
                                No members found.
                            </div>
                        @else
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Nama Anggota</th>
                                        <th scope="col">Alamat Anggota</th>
                                        <th scope="col">Handphone</th>
                                        <th scope="col">Tipe Member</th>
                                        <th scope="col">Penabung</th>
                                        <th scope="col">Peminjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{ $member->nama_anggota }}</td>
                                            <td>{{ $member->alamat_anggota }}</td>
                                            <td>{{ $member->handphone }}</td>
                                            <td>{{ $member->tipe_member }}</td>
                                            <td>{{ $member->is_penabung ? 'Yes' : 'No' }}</td>
                                            <td>{{ $member->is_peminjam ? 'Yes' : 'No' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 1000px;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .card-header {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background: linear-gradient(45deg, #007bff, #0056b3);
        }

        .table thead {
            background: #0056b3;
            color: #fff;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.2);
        }

        .alert-info {
            background-color: #e9f7ff;
            border-color: #bce5fc;
            color: #31708f;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1.125rem;
        }
    </style>