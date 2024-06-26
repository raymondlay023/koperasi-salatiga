<div>
    {{-- <button @click="openModal('edit-penjualan-modal-{{ $row->id }}')"
        class="mt-5 px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>

    </button>
    <x-custom-modal id="edit-penjualan-modal-{{ $row->id }}" title="Edit Penjualan (id = {{ $row->id }})">
        <!-- Modal 1 content goes here -->
        <p class="text-sm text-gray-700 dark:text-gray-400">
        <form method="POST" action="{{ route('penjualan.update', $row->id) }}"
            id="formEditPenjualan{{ $row->id }}">
            @method('put')
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
        </form>
        </p>
        <x-slot name="footer">
            <!-- Footer content goes here -->
            <button onclick="document.getElementById('formEditPenjualan{{ $row->id }}').submit()"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Save Changes
            </button>
        </x-slot>
    </x-custom-modal> --}}
    <button @click="openModal('delete-penjualan-modal-{{ $row->id }}')"
        class="mt-5 px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>

    </button>
    <x-custom-modal id="delete-penjualan-modal-{{ $row->id }}" title="Are you sure want to delete this Penjualan?">
        <!-- Modal 1 content goes here -->
        <form method="POST" action="{{ route('penjualan.destroy', $row->id) }}"
            id="formDeletePenjualan{{ $row->id }}">
            @method('delete')
            @csrf
            <div class="form-group">
                <x-input-label :value="_('ID')"></x-input-label>{{ $row->id }}
            </div>
            <div class="form-group mt-2">
                <x-input-label :value="_('Item')"></x-input-label>{{ $row->item_name }}
            </div>
            {{-- <div id="stock_display" class="font-bold text-gray-700">
                <!-- Stock information will be displayed here -->
            </div> --}}
            <div class="form-group mt-2">
                <x-input-label :value="_('Jumlah Jual')"></x-input-label>{{ $row->jumlah_jual }}
            </div>
            <div class="form-group mt-2">
                <x-input-label :value="_('Harga Jual')"></x-input-label>{{ $row->harga_jual }}
            </div>
            <div class="form-group mt-2">
                <x-input-label :value="_('Customer')"></x-input-label>{{ $row->customer }}
            </div>
            <div class="form-group mt-2">
                <x-input-label :value="_('Status')"></x-input-label>{{ $row->status }}
            </div>
            <div class="form-group mt-2">
                <x-input-label :value="_('Tanggal Jual')"></x-input-label>{{ $row->tanggal_jual }}
            </div>
        </form>
        <x-slot name="footer">
            <!-- Footer content goes here -->
            <button onclick="document.getElementById('formDeletePenjualan{{ $row->id }}').submit()"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Delete
            </button>
        </x-slot>
    </x-custom-modal>
</div>
