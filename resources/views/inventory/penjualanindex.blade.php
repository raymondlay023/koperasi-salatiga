<!-- resources/views/penjualan/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Penjualan</title>
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
</head>
<body>
    <form method="POST" action="{{ route('penjualan.store') }}">
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
        <div id="stock_display" class="form-group" style="font-weight: bold; color: #333;">
            <!-- Stock information will be displayed here -->
        </div>
        <div class="form-group">
            <label for="jumlah_jual">Jumlah Jual:</label>
            <input type="number" class="form-control" id="jumlah_jual" name="jumlah_jual" min="0" required>
        </div>
        <div class="form-group">
            <label for="harga_jual">Harga Jual:</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" min="0" required>
        </div>
        <div class="form-group">
            <label for="customer">Customer:</label>
            <input type="text" class="form-control" id="customer" name="customer" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Tunai">Tunai</option>
                <option value="Credit">Credit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_jual">Tanggal Jual:</label>
            <input type="date" class="form-control" id="tanggal_jual" name="tanggal_jual" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @if($penjualan->isEmpty())
        <p style="text-align: center;">No selling history available.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Jual</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Tanggal Jual</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan as $selling)
                    <tr>
                        <td>{{ $selling->inventory->item_name }}</td>
                        <td>{{ $selling->jumlah_jual }}</td>
                        <td>{{ $selling->harga_jual }}</td>
                        <td>{{ $selling->customer }}</td>
                        <td>{{ $selling->status }}</td>
                        @php
                            $totalharga = $selling->jumlah_jual * $selling->harga_jual;
                            $totalharga_idr = number_format($totalharga, 0, ',', '.');
                        @endphp
                        <td>Rp.{{ $totalharga_idr }}</td>
                        <td>{{ $selling->tanggal_jual }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>


<script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeBarangSelect = document.getElementById('tipe_barang');
            const itemSelect = document.getElementById('item_id');
            const jumlahBarangInput = document.getElementById('jumlah_jual');
            const stockDisplay = document.getElementById('stock_display');
            const submitButton = document.querySelector('button[type="submit"]');
            const inventoryData = @json($datas);

            tipeBarangSelect.addEventListener('change', function() {
                const selectedType = this.value;
                updateItemDropdown(selectedType);
            });

            itemSelect.addEventListener('change', function() {
                updateStockDisplay();
                validateQuantity();
            });

            jumlahBarangInput.addEventListener('input', function() {
                validateQuantity();
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

            function updateStockDisplay() {
                const selectedItemId = itemSelect.value;
                const selectedItem = inventoryData.find(item => item.id == selectedItemId);

                if (selectedItem) {
                    stockDisplay.textContent = `Available Stock: ${selectedItem.stock}`;
                } else {
                    stockDisplay.textContent = '';
                }
            }

            function validateQuantity() {
            const selectedItemId = itemSelect.value;
            const selectedItem = inventoryData.find(item => item.id == selectedItemId);

            if (selectedItem) {
                const stock = selectedItem.stock;
                const quantityInput = jumlahBarangInput.value;

                if (!quantityInput || isNaN(quantityInput)) {
                    jumlahBarangInput.setCustomValidity('Please enter a valid quantity.');
                    submitButton.disabled = true;
                    alert('Please enter a valid quantity.');
                } else {
                    const quantity = parseInt(quantityInput);

                    if (quantity > stock) {
                        jumlahBarangInput.setCustomValidity('The quantity cannot exceed the available stock.');
                        submitButton.disabled = true;
                    } else {
                        jumlahBarangInput.setCustomValidity('');
                        submitButton.disabled = false;
                    }
                }
            }
        }

        });
    </script>
</html>
