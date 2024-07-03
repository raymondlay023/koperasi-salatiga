<x-laporan-layout>
    @include('partials.alert-success-error')
    <div class="text-center">
        <span class="text-2xl font-semibold">
            Laporan Inventory
        </span>
    </div>
    <div class="mt-8 text-center">
        <form action="{{ route('inventory.laporan.result') }}" method="GET">
            @csrf

            <div class="form-group mb-4">
                <x-input-label for="category" :value="_('Category')" class="inline me-2 text-lg" />
                <select id="category" name="category" required
                    class="mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                    <option selected disabled value="">
                        --Pilih tipe barang--
                    </option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-5">
                <x-input-label for="start_date" :value="_('Start Date')" class="inline me-2 text-lg" />
                <x-text-input type="date" class="form-control" id="start_date" name="start_date"
                    required></x-text-input>
            </div>

            <div class="mt-5">
                <x-input-label for="end_date" :value="_('End Date')" class="inline me-2 text-lg" />
                <x-text-input type="date" class="form-control" id="end_date" name="end_date"
                    required></x-text-input>
            </div>

            <div class="mt-8">
                <x-primary-button>
                    <span>Submit</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</x-laporan-layout>
