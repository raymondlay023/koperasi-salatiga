<x-app-layout>
    @section('content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Tabungan Form</h1>
    <form action="{{ route('tabungan.insert') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Status Tabungan:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ str_replace('_', ' ', $status) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tabungan_id ">Member:</label>
            <select name="tabungan_id" id="tabungan_id" class="form-control" required>
                <option value="">Select Member</option>
                @foreach($tabungans as $tabungan)
                    <option value="{{ $tabungan->id }}" data-status="{{ $tabungan->status ?? '' }}">{{ $tabungan->membertabungan->nama_anggota }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="setor">Jumlah Setor:</label>
            <input type="number" name="setor" id="setor" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tarikan">Jumlah Tarikan:</label>
            <input type="number" name="tarikan" id="tarikan" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="setor_date">Tanggal Setor :</label>
            <input type="date" name="setor_date" id="setor_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="remark">Deskripsi :</label>
            <input type="text" name="remark" id="remark" class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#status').change(function() {
            var selectedStatus = $(this).val();
            $('#tabungan_id option').each(function() {
                var memberStatus = $(this).data('status');
                if (selectedStatus === '' || memberStatus === selectedStatus) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#tabungan_id').val('');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
            const setorInput = document.getElementById('setor');
            const tarikanInput = document.getElementById('tarikan');

            setorInput.addEventListener('input', function () {
                if (setorInput.value) {
                    tarikanInput.disabled = true;
                } else {
                    tarikanInput.disabled = false;
                }
            });

            tarikanInput.addEventListener('input', function () {
                if (tarikanInput.value) {
                    setorInput.disabled = true;
                } else {
                    setorInput.disabled = false;
                }
            });
        });
</script>



    @endsection
    </x-app-layout>