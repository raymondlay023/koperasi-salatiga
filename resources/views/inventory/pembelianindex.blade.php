<!-- resources/views/pembelian/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pembelian</title>
    <style>
        form {
            width: 300px;
            margin: 0 auto;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .no-data {
            text-align: center;
            color: red;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeBarangSelect = document.getElementById('tipe_barang');
            const itemSelect = document.getElementById('item_id');
            const inventoryData = @json($datas);

            tipeBarangSelect.addEventListener('change', function() {
                const selectedType = this.value;
                updateItemDropdown(selectedType);
            });

            function updateItemDropdown(selectedType) {
                itemSelect.innerHTML = '';
                const filteredItems = inventoryData.filter(item => item.tipe_barang === selectedType);

                filteredItems.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.item_name;
                    itemSelect.appendChild(option);
                });
            }
        });
    </script>
</head>
<body>
    <form method="POST" action="{{ route('pembelian.store') }}">
        @csrf
        <div class="form-group">
            <label for="tipe_barang">Tipe Barang:</label>
            <select class="form-control" id="tipe_barang" name="tipe_barang" required>
                <option value="">Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->tipe_barang }}">{{ $type->tipe_barang }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="item_id">Item:</label>
            <select class="form-control" id="item_id" name="item_id" required>
                <option value="">Select Item</option>
                <!-- Items will be populated based on selected type -->
            </select>
        </div>
        <div class="form-group">
            <label for="jumlah_barang">Jumlah Barang:</label>
            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" min="0" required>
        </div>
        <div class="form-group">
            <label for="harga_beli">Harga Beli:</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="0" required>
        </div>
        <div class="form-group">
            <label for="supplier">Supplier:</label>
            <input type="text" class="form-control" id="supplier" name="supplier" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Tunai">Tunai</option>
                <option value="Credit">Credit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_beli">Tanggal Beli:</label>
            <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



    @if($pembelian->isEmpty())
        <p style="text-align: center;">No purchase history available.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Beli</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Tanggal Beli</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelian as $purchase)
                    <tr>
                        <td>{{ $purchase->inventory->item_name }}</td>
                        <td>{{ $purchase->jumlah_barang }}</td>
                        <td>{{ $purchase->harga_beli }}</td>
                        <td>{{ $purchase->supplier }}</td>
                        <td>{{ $purchase->status }}</td>
                        @php
                            $totalharga = $purchase->harga_beli * $purchase->jumlah_barang;
                            $totalharga_idr = number_format($totalharga, 0, ',', '.');
                        @endphp
                        <td>Rp.{{ $totalharga_idr }}</td>
                        <td>{{ $purchase->tanggal_beli }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
