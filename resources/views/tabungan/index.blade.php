<x-app-layout>
    @section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tabungan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        form {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<a href="{{ route('tabungan.setor') }}" class="btn btn-primary">Setor Tabungan</a>
<a href="{{ route('list.transaksi.tabungan')}}"  class="btn btn-primary">List Transaksi</a>
<form method="POST" action="{{ route('tabungan.store') }}">
    @csrf
    <div class="form-group">
        <label for="member_id">Member ID:</label>
        <select class="form-control" id="member_id" name="member_id" required>
            <option value="">Select Member</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="saldo">Saldo:</label>
        <input type="number" class="form-control" id="saldo" name="saldo" required>
    </div>
    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
    </div>
    <div class="form-group">
        <label for="status">Jenis Simpanan:</label>
        <select class="form-control" id="status" name="status" required>
            <option value="simpanan_pokok">Simpanan Pokok</option>
            <option value="simpanan_wajib">Simpanan Wajib</option>
            <option value="simpanan_bagong">Simpanan Bagong</option>
            <option value="simpanan_semar">Simpanan Semar</option>
            <option value="simpanan_kedelai">Simpanan Kedelai</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@if($tabungans->isEmpty())
        <p style="text-align: center;">No Member available.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Handphone</th>
                    <th>Saldo</th>
                    <th>Tanggal Mulai Menabung</th>
                    <th>Jenis Tabungan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabungans as $tabungan)
                    <tr>
                        <td>{{ $tabungan->membertabungan->nama_anggota }}</td>
                        <td>{{ $tabungan->membertabungan->handphone }}</td>
                        <td>{{ $tabungan->saldo }}</td>
                        <td>{{ $tabungan->start_date }}</td>
                        <td>{{ str_replace('_', ' ', $tabungan->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

    @endsection
</x-app-layout>