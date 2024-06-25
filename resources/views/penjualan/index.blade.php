@extends('layouts.app')

@section('content')

    @include('partials.alert-success-error')

    <div class="m-10">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" action="{{ route('penjualan.store') }}">
                @csrf
                <div class="form-group">
                    <x-input-label for="tipe_barang" :value="_('Tipe Barang')"></x-input-label>
                    <x-select-input placeholder="Select Type" id="tipe_barang" name="tipe_barang" required>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="itemName" :value="_('Item')"></x-input-label>
                    <x-select-input placeholder="Select Item" id="item_id" name="item_id" required>
                        <!-- Items will be populated based on selected type -->
                    </x-select-input>
                </div>
                <div id="stock_display" class="font-bold text-gray-700">
                    <!-- Stock information will be displayed here -->
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="jumlah_jual" :value="_('Jumlah Jual')"></x-input-label>
                    <x-text-input type="number" id="jumlah_jual" class="block mt-1 w-full" name="jumlah_jual"
                        :value="old('jumlah_jual')" required min="0" value="0" />
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="harga_jual" :value="_('Harga Jual')"></x-input-label>
                    <x-text-input type="number" id="harga_jual" class="block mt-1 w-full" name="harga_jual"
                        :value="old('harga_jual')" required min="0" value="0" />
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="customer" :value="_('Customer')"></x-input-label>
                    <x-text-input type="text" id="customer" class="block mt-1 w-full" name="customer" :value="old('customer')"
                        required />
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="status" :value="_('Status')"></x-input-label>
                    <x-select-input id="status" name="status" required>
                        <option value="Tunai">Tunai</option>
                        <option value="Credit">Credit</option>
                    </x-select-input>
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="tanggal_jual" :value="_('Tanggal Jual')"></x-input-label>
                    <x-text-input type="date" id="tanggal_jual" class="block mt-1 w-full" name="tanggal_jual"
                        :value="old('tanggal_jual')" required />
                </div>
                <div class="form-group mt-7">
                    <x-primary-button class="w-full"> <span class="w-full">Submit</span> </x-primary-button>
                </div>
            </form>
        </div>

    </div>

    @if ($penjualan->isEmpty())
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
                @foreach ($penjualan as $selling)
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
@endsection

@push('extraJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeBarangSelect = document.getElementById('tipe_barang');
            const itemSelect = document.getElementById('item_id');
            const jumlahBarangInput = document.getElementById('jumlah_jual');
            const stockDisplay = document.getElementById('stock_display');
            const submitButton = document.querySelector('button[type="submit"]');
            const inventoryData = @json($datas);

            // console.log(inventoryData); // Debugging log

            tipeBarangSelect.addEventListener('change', function() {
                const selectedType = this.value;
                console.log('Selected Type:', selectedType); // Debugging log
                updateItemDropdown(selectedType);
                updateStockDisplay();
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
                const filteredItems = inventoryData.filter(item => item.item_type_id.toString() === selectedType
                    .toString());
                console.log('Filtered Items:', filteredItems); // Debugging log

                filteredItems.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.item_name;
                    itemSelect.appendChild(option);
                });
            }

            function updateStockDisplay() {
                const selectedItemId = itemSelect.value;
                const selectedItem = inventoryData.find(item => item.id.toString() === selectedItemId.toString());

                if (selectedItem) {
                    stockDisplay.textContent = `Available Stock: ${selectedItem.stock}`;
                    jumlahBarangInput.setAttribute('max', selectedItem.stock);
                } else {
                    stockDisplay.textContent = '';
                }
            }

            function validateQuantity() {
                const selectedItemId = itemSelect.value;
                const selectedItem = inventoryData.find(item => item.id.toString() === selectedItemId.toString());

                if (selectedItem) {
                    const stock = selectedItem.stock;
                    const quantityInput = jumlahBarangInput.value;

                    if (!quantityInput || isNaN(quantityInput)) {
                        // jumlahBarangInput.setCustomValidity('Please enter a valid quantity.');
                        submitButton.disabled = true;
                        alert('Please enter a valid quantity.');
                    } else {
                        const quantity = parseInt(quantityInput);

                        if (quantity > stock) {
                            alert('The quantity cannot exceed the available stock.');
                            // jumlahBarangInput.setCustomValidity('The quantity cannot exceed the available stock.');
                            // submitButton.disabled = true;
                        } else {
                            // jumlahBarangInput.setCustomValidity('');
                            submitButton.disabled = false;
                        }
                    }
                }
            }
        });
    </script>
@endpush
