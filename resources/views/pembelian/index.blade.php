@extends('layouts.app')

@section('content')
    <div class="p-10">
        @include('partials.alert-success-error')

        <div class="justify-between flex">
            <div>
                <p>
                    <a href="{{ route('pembelian.index') }}" class="text-blue-800"> Pembelian </a> > <span
                        class="text-gray-500">List</span>
                </p>
                <p class="text-5xl font-bold">
                    Pembelian List
                </p>
            </div>
            <div>
                <button @click="openModal('create-pembelian-modal')"
                    class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Create Pembelian
                </button>
            </div>
        </div>


        <x-custom-modal id="create-pembelian-modal" title="Create Pembelian">
            <form method="POST" action="{{ route('pembelian.store') }}" id="formCreatePembelian">
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
                <div class="form-group mt-3">
                    <x-input-label for="jumlah_barang" :value="_('Jumlah Barang')"></x-input-label>
                    <x-text-input type="number" id="jumlah_barang" class="block mt-1 w-full" name="jumlah_barang"
                        :value="old('jumlah_barang')" required min="0" value ="0" />
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="harga_beli" :value="_('Harga Beli')"></x-input-label>
                    <x-text-input type="number" id="harga_beli" class="block mt-1 w-full" name="harga_beli"
                        :value="old('harga_beli')" required min="0" value ="0" />
                </div>
                <div class="form-group mt-3">
                    <x-input-label for="supplier">Supplier</x-input-label>
                    <x-text-input type="text" id="supplier" class="block mt-1 w-full" name="supplier" :value="old('supplier')"
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
                    <x-input-label for="tanggal_beli" :value="_('Tanggal Beli')"></x-input-label>
                    <x-text-input type="date" id="tanggal_beli" class="block mt-1 w-full" name="tanggal_beli"
                        :value="old('tanggal_beli')" required />
                </div>
            </form>
            <x-slot name="footer">
                <x-primary-button onclick="document.getElementById('formCreatePembelian').submit()">
                    <span>Submit</span> </x-primary-button>
            </x-slot>
        </x-custom-modal>

        <div class="my-10">
            <livewire:pembelian-table />
        </div>
    </div>
@endsection

@push('extraJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeBarangSelect = document.getElementById('tipe_barang');
            const itemSelect = document.getElementById('item_id');
            const inventoryData = @json($datas);
            console.log(inventoryData);

            tipeBarangSelect.addEventListener('change', function() {
                const selectedType = this.value;
                console.log(selectedType);
                updateItemDropdown(selectedType);
            });

            function updateItemDropdown(selectedType) {
                itemSelect.innerHTML = '';
                const filteredItems = inventoryData.filter(item => item.item_type_id.toString() === selectedType
                    .toString());

                filteredItems.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.item_name;
                    itemSelect.appendChild(option);
                });
            }
        });
    </script>
@endpush
