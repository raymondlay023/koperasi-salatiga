<x-app-layout>
    @section('content')
        <div class="container pt-10 ps-10">
            <div class="justify-between flex">
                <div>
                    <p>
                        <a href="{{ route('tabungan.index') }}" class="text-blue-800"> Tabungan </a> > <span
                            class="text-gray-500">List</span>
                    </p>
                    <p class="text-5xl font-bold">
                        Tabungan Lists
                    </p>
                </div>
                <div>
                    <a href="{{ route('list.transaksi.tabungan') }}"
                        class="mx-2 px-4 py-2 focus:ri  ng-2 focus:ring-emerald-500 focus:ring-offset-2 text-sm font-medium text-emerald-600 hover:text-white transition-colors duration-150 bg-transparent border border-emerald-600 rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-emerald-400">Transaksi
                        Tabungan</a>
                    <button @click="openModal('create-tabungan-modal')"
                        class="focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-600 border border-transparent rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-emerald-400">
                        Create Tabungan
                    </button>
                </div>
            </div>

            <x-custom-modal id="create-tabungan-modal" title="Create tabungan">
                <form action="{{ route('tabungan.store') }}" method="post" id="formCreateTabungan">
                    @csrf
                    <div class="form-group">
                        <x-input-label for="member_id" :value="_('Member ID')" />
                        <x-select-input id="member_id" name="member_id" placeholder="Select Member" required>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="saldo" :value="_('Saldo')" />
                        <x-text-input class="block w-full mt-1" type="number" id="saldo" name="saldo" required />
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="start_date" :value="_('Start Date')" />
                        <x-text-input class="block w-full mt-1" type="date" id="start_date" name="start_date" required />
                    </div>
                    <div class="form-group mt-4">
                        <x-input-label for="status" :value="_('Jenis Simpanan')" />
                        <x-select-input id="status" name="status" required>
                            <option value="Simpanan Pokok">Simpanan Pokok</option>
                            <option value="Simpanan Wajib">Simpanan Wajib</option>
                            <option value="Simpanan Bagong">Simpanan Bagong</option>
                            <option value="Simpanan Semar">Simpanan Semar</option>
                            <option value="Simpanan Kedelai">Simpanan Kedelai</option>
                        </x-select-input>
                    </div>
                </form>

                <x-slot name="footer">
                    <x-primary-button onclick="submitFormWithValidation()">
                        Submit </x-primary-button>
                </x-slot>
            </x-custom-modal>
            <div class="py-10">
                <livewire:tabungan-table />
            </div>
        </div>
    @endsection
    @push('extraJs')
        <script>
            function submitFormWithValidation() {
                const form = document.getElementById('formCreateTabungan');
                if (form.reportValidity()) {
                    form.submit();
                }
            }
        </script>
    @endpush
</x-app-layout>
