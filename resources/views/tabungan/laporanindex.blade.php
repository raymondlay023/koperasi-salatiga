<x-laporan-layout>
    @include('partials.alert-success-error')
    <div class="text-center">
        <span class="text-2xl font-semibold">
            Laporan Tabungan
        </span>
    </div>
    <div class="mt-8 text-center">
        <form action="{{ route('tabungan.laporan.result') }}" method="GET">
            @csrf

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
