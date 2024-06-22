@push('head')
    <script src="{{ asset('js/focus-trap.js') }}" defer></script>
@endpush
<x-app-layout>
    @section('content')
        <div class="container p-10">

            <div class="justify-between flex">
                <div>
                    <p>
                        <a href="{{ route('inventory.stock') }}" class="text-blue-800"> Inventories </a> > <span
                            class="text-gray-500">List</span>
                    </p>
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
                <!-- Modal 1 content goes here -->
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
                    <!-- Footer content goes here -->
                    <button onclick="document.getElementById('formCreateInventory').submit()"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                        Submit
                    </button>
                </x-slot>
            </x-custom-modal>

            {{-- <!-- Modal backdrop. This what you want to place close to the closing body tag -->
            <div x-show="isModalOpen('modal1')" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                <!-- Modal -->
                <div x-show="isModalOpen('modal1')" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal('modal1')"
                    @keydown.escape="closeModal('modal1')"
                    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                    role="dialog" id="modal">
                    <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                    <header class="flex justify-between">
                        <!-- Modal title -->
                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                            Create Item
                        </p>
                        <button
                            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                            aria-label="close" @click="closeModal('modal1')">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                <path
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </header>
                    <!-- Modal body -->
                    <div class="mt-4 mb-6">
                        <!-- Modal description -->

                    </div>
                    <footer
                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                        <button @click="closeModal('modal1')"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                        <button onclick="document.getElementById('formCreateStock').submit()"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                            Submit
                        </button>
                    </footer>
                </div>
            </div>
            <!-- End of modal backdrop --> --}}

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
