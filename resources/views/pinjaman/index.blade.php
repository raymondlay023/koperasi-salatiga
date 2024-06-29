<x-app-layout>
    @section('content')
        @include('partials.alert-success-error')
        <div class="pt-10 ps-10 container">
            <div class="justify-between flex">
                <div>
                    <p>
                        <a href="{{ route('pinjaman.index') }}" class="text-blue-800"> Pinjaman </a> > <span
                            class="text-gray-500">List</span>
                    </p>
                    <p class="text-5xl font-bold">
                        Pinjaman List
                    </p>
                </div>
                <div>
                    <a href="{{ route('list.pinjaman.transaction') }}"
                        class="mx-2 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 text-sm font-medium text-emerald-600 hover:text-white transition-colors duration-150 bg-transparent border border-emerald-600 rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-emerald-400">Transaksi
                        Pinjaman</a>
                    <button @click="openModal('create-pinjaman-modal')"
                        class="focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-600 border border-transparent rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-emerald-400">
                        Create Pinjaman
                    </button>
                </div>
            </div>

            <x-custom-modal id="create-pinjaman-modal" title="Create Pinjaman">
                <form method="POST" action="{{ route('pinjaman.store') }}" id="formCreatePinjaman">
                    @csrf
                    <div class="form-group">
                        <x-input-label for="member_id" :value="_('Member ID')"></x-input-label>
                        <x-select-input id="member_id" name="member_id" placeholder="Select member" required>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="jumlah_pinjaman" :value="_('Jumlah Pinjaman')"></x-input-label>
                        <x-text-input class="block mt-1 w-full" type="text" id="jumlah_pinjaman" name="jumlah_pinjaman"
                            required></x-text-input>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="start_date" :value="_('Start Date')"></x-input-label>
                        <x-text-input class="block mt-1 w-full" type="date" id="start_date" name="start_date"
                            required></x-text-input>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="tenor" :value="_('Tenor')"></x-input-label>
                        <x-select-input id="tenor" name="tenor" required>
                            <option value="10">10</option>
                        </x-select-input>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="total_bayar" :value="_('Total Bayar')"></x-input-label>
                        <x-text-input class="bg-slate-100 block mt-1 w-full" type="text" id="total_bayar"
                            name="total_bayar" readonly></x-text-input>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="bayar_perbulan" :value="_('Bayar Perbulan')"></x-input-label>
                        <x-text-input class="bg-slate-100 block mt-1 w-full" type="text" id="bayar_perbulan"
                            name="bayar_perbulan" readonly></x-text-input>
                    </div>
                </form>
                <x-slot name="footer">
                    <x-primary-button onclick="submitFormWithValidation()">
                        Submit </x-primary-button>
                </x-slot>
            </x-custom-modal>

            <div class="my-10">
                <livewire:pinjaman-table />
            </div>
        </div>
    @endsection
    @push('extraJs')
        <script>
            function submitFormWithValidation() {
                const form = document.getElementById('formCreatePinjaman');
                if (form.reportValidity()) {
                    form.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const jumlahPinjamanInput = document.getElementById('jumlah_pinjaman');
                const tenorSelect = document.getElementById('tenor');
                const totalBayarInput = document.getElementById('total_bayar');
                const bayarPerbulanInput = document.getElementById('bayar_perbulan');

                function formatRupiah(amount) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(amount);
                }

                function calculateValues() {
                    const jumlahPinjaman = parseFloat(jumlahPinjamanInput.value.replace(/[^,\d]/g, ''));
                    const tenor = parseInt(tenorSelect.value);

                    if (!isNaN(jumlahPinjaman) && !isNaN(tenor)) {
                        const totalBayar = jumlahPinjaman * 1.2; // Jumlah Pinjaman + 20%
                        const bayarPerbulan = totalBayar / tenor;

                        totalBayarInput.value = formatRupiah(totalBayar);
                        bayarPerbulanInput.value = formatRupiah(bayarPerbulan);
                    } else {
                        totalBayarInput.value = '';
                        bayarPerbulanInput.value = '';
                    }
                }

                jumlahPinjamanInput.addEventListener('input', function() {
                    const formattedValue = formatRupiah(parseFloat(this.value.replace(/[^,\d]/g, '')));
                    this.value = formattedValue;
                    calculateValues();
                });

                tenorSelect.addEventListener('change', calculateValues);
            });
        </script>
    @endpush
</x-app-layout>
