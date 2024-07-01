<x-app-layout>
    @section('content')
        @include('partials.alert-success-error')
        <div class="container pt-10 ps-10">
            <div class="justify-between flex">
                <div>
                    <p>
                        <a href="{{ route('tabungan.index') }}" class="text-blue-800">
                            Tabungan
                        </a>
                        >
                        <a href="{{ route('list.transaksi.tabungan') }}" class="text-blue-800">
                            Tabungan Transactions
                        </a>
                        >
                        <span class="text-gray-500">List</span>
                    </p>
                    <p class="text-5xl font-bold">
                        Tabungan Transactions
                    </p>
                </div>
                <div>
                    <button @click="openModal('create-tabungan-transaction-modal')"
                        class="focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-600 border border-transparent rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-blue-400">
                        Create Transaksi Tabungan
                    </button>
                </div>
                <x-custom-modal id="create-tabungan-transaction-modal" title="Create Transaksi Tabungan">
                    <form action="{{ route('tabungan.insert') }}" method="POST" id="createTabunganTransaction">
                        @csrf
                        <div class="form-group">
                            <x-input-label for="status" :value="_('Status tabungan')" />
                            <x-select-input name="status" id="status" placeholder="Select status" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}">{{ str_replace('_', ' ', $status) }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="form-group mt-4">
                            <x-input-label for="tabungan_id" :value="_('Member')" />
                            <x-select-input name="tabungan_id" id="tabungan_id" placeholder="Select member" required>
                                @foreach ($tabungans as $tabungan)
                                    <option value="{{ $tabungan->id }}" data-status="{{ $tabungan->status ?? '' }}">
                                        {{ $tabungan->membertabungan->nama_anggota }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="form-group mt-4">
                            <x-input-label :value="_('Jenis Transaksi')" />
                            <x-radio-button name="jenis_transaksi" value="setor" label="Setor"
                                onclick="toggleInput('setor')" />
                            <x-radio-button name="jenis_transaksi" value="tarik" label="Tarik"
                                onclick="toggleInput('tarik')" />
                        </div>

                        <div class="form-group mt-4" id="setor-form-group">
                            <x-input-label for="setor" :value="_('Jumlah Setor')" />
                            <x-text-input type="number" name="setor" id="setor" class="w-full mt-1 block" required />
                        </div>

                        <div class="form-group mt-4" id="tarikan-form-group">
                            <x-input-label for="tarikan" :value="_('Jumlah Tarikan')" />
                            <x-text-input type="number" name="tarikan" id="tarikan" class="w-full mt-1 block" required />
                        </div>

                        <div class="form-group mt-4">
                            <x-input-label for="setor_date" :value="_('Tanggal Transaksi')" />
                            <x-text-input type="date" name="setor_date" id="setor_date" class="w-full mt-1 block"
                                required />
                        </div>

                        <div class="form-group mt-4">
                            <x-input-label for="remark" :value="_('Deskripsi')" />
                            <x-text-input type="text" name="remark" id="remark" class="w-full mt-1 block" required />
                        </div>
                    </form>
                    <x-slot name="footer">
                        <x-primary-button onclick="submitFormWithValidation()">
                            Submit </x-primary-button>
                    </x-slot>
                </x-custom-modal>

            </div>
            <div class="py-10">
                <livewire:tabungan-transaction-table />
            </div>
        </div>
    @endsection
    @push('extraJs')
        <script>
            const setorFormGroup = document.getElementById('setor-form-group');
            const tarikanFormGroup = document.getElementById('tarikan-form-group');
            const setorInput = document.getElementById('setor');
            const tarikanInput = document.getElementById('tarikan');

            setorFormGroup.style.display = 'none';
            tarikanFormGroup.style.display = 'none';

            function toggleInput(action) {
                setorFormGroup.style.display = 'none';
                tarikanFormGroup.style.display = 'none';
                setorInput.disabled = true
                tarikanInput.disabled = true;

                if (action === 'setor') {
                    setorInput.disabled = false;
                    tarikanInput.disabled = true;
                    setorFormGroup.style.display = 'block';
                } else if (action === 'tarik') {
                    setorInput.disabled = true;
                    tarikanInput.disabled = false;
                    tarikanFormGroup.style.display = 'block';
                }
            }

            function submitFormWithValidation() {
                const form = document.getElementById('createTabunganTransaction');
                if (form.reportValidity()) {
                    form.submit();
                }
            }
        </script>
    @endpush
</x-app-layout>
