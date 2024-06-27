<div>
    <button @click="openModal('edit-inventory-modal-{{ $row->id }}')"
        class="mt-5 px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>


    </button>
    <x-custom-modal id="edit-inventory-modal-{{ $row->id }}" title="Edit Item (id = {{ $row->id }})">
        <p class="text-sm text-gray-700 dark:text-gray-400">
        <form method="POST" action="{{ route('inventory.update', $row->id) }}"
            id="formEditInventory{{ $row->id }}">
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
            <button onclick="document.getElementById('formEditInventory{{ $row->id }}').submit()"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Save Changes
            </button>
        </x-slot>
    </x-custom-modal>
    <button @click="openModal('delete-inventory-modal-{{ $row->id }}')"
        class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>

    </button>
    <x-custom-modal id="delete-inventory-modal-{{ $row->id }}" title="Delete Item (id = {{ $row->id }})">
        <!-- Modal 1 content goes here -->
        <p class="text-sm text-gray-700 dark:text-gray-400">
        <form method="POST" action="{{ route('inventory.destroy', $row->id) }}"
            id="formDeleteInventory{{ $row->id }}">
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
            <button onclick="document.getElementById('formDeleteInventory{{ $row->id }}').submit()"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Delete
            </button>
        </x-slot>
    </x-custom-modal>
</div>
