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
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box; /* Ensure padding and border are included in the width */
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

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination button {
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .pagination button:hover {
            background-color: #0056b3;
        }

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Index</title>
</head>
<body>

<div class="pagination">
        <!-- Button to go to second page -->
        <button onclick="location.href='{{ route('inventory.penjualan.index') }}'">Penjualan</button>
        
        <!-- Button to go to third page -->
        <button onclick="location.href='{{ route('inventory.pembelian.index') }}'">Pembelian</button>
    </div>

    <form method="POST" action="{{ route('inventory.store') }}">
    @csrf
    <div class="form-group">
        <label for="item_name">Item Name:</label>
        <input type="text" class="form-control" id="item_name" name="item_name" required>
    </div>
    <div class="form-group">
        <label for="tipe_barang">Tipe Barang:</label>
        <select class="form-control" id="tipe_barang" name="tipe_barang" required>
            <option value="sembako">Sembako</option>
            <option value="kedelai">Kedelai</option>
            <option value="tahutempe">Tahu & Tempe</option>
        </select>
    </div>
    <div class="form-group">
        <label for="stock">Stock:</label>
        <input type="number" class="form-control" id="stock" name="stock" min="0" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>



    <div class="dropdown">
        <label for="filter_type">Filter by Type:</label>
            <select id="filter_type">
                <option value="">All</option>
                <option value="sembako">Sembako</option>
                <option value="kedelai">Kedelai</option>
                <option value="tahutempe">Tahu & Tempe</option>
            </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Type</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @if($datas->isEmpty())
                <tr>
                    <td colspan="3">No data available</td>
                </tr>
            @else
                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->item_name }}</td>
                    <td>{{ $data->tipe_barang }}</td>
                    <td>{{ $data->stock }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
    <script>
        // JavaScript to filter data based on type selection
        document.getElementById('filter_type').addEventListener('change', function() {
            var type = this.value;
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var typeCell = row.querySelector('td:nth-child(2)');
                if (type === '' || typeCell.textContent === type) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>


    
</body>
</html>


