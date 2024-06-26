<div>
    {{-- <button @click="openModal('edit-penjualan-modal-{{ $row->id }}')"
        class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
        Edit Item
    </button>
    <x-custom-modal id="edit-penjualan-modal-{{ $row->id }}" title="Edit Item (id = {{ $row->id }})">
        <!-- Modal 1 content goes here -->
        <p class="text-sm text-gray-700 dark:text-gray-400">
        <form method="POST" action="{{ route('penjualan.update', $row->id) }}" id="formEditPenjualan{{ $row->id }}">
            @method('put')
            @csrf
            <div class="form-group mt-4">
                <x-input-label for="itemName" :value="_('Item Name')" />
                <x-text-input id="itemName" class="block mt-1 w-full" type="text" name="item_name" :value="$row->item_name"
                    required autofocus />
            </div>
            <div class="form-group mt-4">
                <x-input-label for="tipeBarang" :value="_('Tipe Barang')" />
                <select id="tipeBarang" name="item_type_id" required
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                    <option selected disabled value="">
                        --Pilih tipe barang--
                    </option>
                    @foreach ($types as $type)
                        @if ($row->item_type_id === $type->id)
                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                        @else
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-4">
                <x-input-label for="stock" :value="_('Stock')" />
                <x-text-input id="stock" class="block mt-1 w-full" type="number" min=0 name="stock"
                    :value="$row->stock" required />
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
    </x-custom-modal>
    <button @click="openModal('delete-penjualan-modal-{{ $row->id }}')"
        class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        Delete Item
    </button>
    <x-custom-modal id="delete-penjualan-modal-{{ $row->id }}" title="Delete Item (id = {{ $row->id }})">
        <!-- Modal 1 content goes here -->
        <p class="text-sm text-gray-700 dark:text-gray-400">
        <form method="POST" action="{{ route('penjualan.destroy', $row->id) }}"
            id="formDeletePenjualan{{ $row->id }}">
            @method('delete')
            @csrf
            <div class="form-group mt-1">
                <x-input-label for="itemName" :value="_('Item Name')" /> {{ $row->item_name }}

            </div>
            <div class="form-group mt-1">
                <x-input-label for="tipeBarang" :value="_('Tipe Barang')" /> {{ $row->type->name }}

            </div>
            <div class="form-group mt-1">
                <x-input-label for="stock" :value="_('Stock')" /> {{ $row->stock }}

            </div>
        </form>
        </p>
        <x-slot name="footer">
            <!-- Footer content goes here -->
            <button onclick="document.getElementById('formDeletePenjualan{{ $row->id }}').submit()"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Delete
            </button>
        </x-slot>
    </x-custom-modal> --}}
</div>
