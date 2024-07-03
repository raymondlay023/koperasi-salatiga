@push('head')
    <script src="{{ asset('js/focus-trap.js') }}" defer></script>
@endpush
<x-app-layout>
    @section('content')
        <div class="pt-10 ps-10 container">
            <div class="justify-between items-center flex mb-6">
                <div>
                    <p class="text-5xl font-bold">
                        Inventories
                    </p>
                </div>
                <div>
                    <button @click="openModal('create-inventory-modal')"
                        class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Create Item
                    </button>
                </div>
            </div>

            <x-custom-modal id="create-inventory-modal" title="Create Item">
                <p class="text-sm text-gray-700 dark:text-gray-400">
                <form method="POST" action="{{ route('inventory.store') }}" id="formCreateInventory">
                    @csrf
                    <div class="form-group mt-4">
                        <x-input-label for="itemName" :value="_('Item Name')" />
                        <x-text-input id="itemName" class="block mt-1 w-full" type="text" name="item_name"
                            :value="old('item_name')" required autofocus />
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="tipeBarang" :value="_('Tipe Barang')" />
                        <select id="tipeBarang" name="item_type_id" required
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <option selected disabled value="">
                                --Pilih tipe barang--
                            </option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="stock" :value="_('Stock')" />
                        <x-text-input id="stock" class="block mt-1 w-full" type="number" min=0 name="stock"
                            :value="old('stock')" required />
                    </div>
                </form>
                </p>
                <x-slot name="footer">
                    <button onclick="document.getElementById('formCreateInventory').submit()"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Submit
                    </button>
                </x-slot>
            </x-custom-modal>

            <div class="my-10">
                <livewire:inventory-table />
            </div>
        </div>
    @endsection
    @push('script')
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
    @endpush
</x-app-layout>
