<x-app-layout>
    @section('content')
        <div class="pt-10 ps-10 container">
            <div class="justify-between flex">
                <div>
                    <p>
                        <a href="{{ route('pinjaman.index') }}" class="text-blue-800">
                            Pinjaman
                        </a>
                        >
                        <a href="{{ route('list.pinjaman.transaction') }}" class="text-blue-800">
                            Pinjaman Transactions
                        </a>
                        >
                        <span class="text-gray-500">List</span>
                    </p>
                    <p class="text-5xl font-bold">
                        Pinjaman Transactions
                    </p>
                </div>
                <div>
                    <button @click="openModal('create-pinjaman-transaction-modal')"
                        class="focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-600 border border-transparent rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-blue-400">
                        Create Pembayaran Pinjaman
                    </button>
                </div>
            </div>

            <x-custom-modal id="create-pinjaman-transaction-modal" title="Pembayaran pinjaman">
                <form action="{{ route('pinjaman.bayarproses') }}" method="POST" id="formCreateTransaction">
                    @csrf
                    <div class="form-group">
                        <x-input-label for="pinjaman_id" :value="_('Choose Member')" />
                        <x-select-input name="pinjaman_id" id="pinjaman_id" placeholder="Select Member">
                            @foreach ($pinjamans->where('is_lunas', 0) as $pinjaman)
                                <option value="{{ $pinjaman->id }}" data-bayar-perbulan="{{ $pinjaman->bayar_perbulan }}">
                                    {{ $pinjaman->id }} - {{ $pinjaman->memberpinjaman->nama_anggota }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    <div class="form-group mt-3">
                        <x-input-label for="bayar" :value="_('Bayar (Rp)')" />
                        <x-text-input type="text" name="bayar" id="bayar" placeholder="Enter amount in Rp"
                            class="block w-full mt-1"></x-text-input>
                    </div>
                    <div class="form-group mt-3">
                        <x-input-label for="remark" :value="_('Remark')" />
                        <x-textarea id="remark" name="remark" placeholder="Catatan pembayaran" rows="5" />
                    </div>
                </form>
                <x-slot name="footer">
                    <x-primary-button onclick="submitFormWithValidation()">
                        Process Payment </x-primary-button>
                </x-slot>
            </x-custom-modal>
            <div class="py-10">
                <livewire:pinjaman-transaction-table />
            </div>
        </div>

        <script>
            function submitFormWithValidation() {
                const form = document.getElementById('formCreateTransaction');
                if (form.reportValidity()) {
                    form.submit();
                }
            }
            document.getElementById('pinjaman_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var bayarPerbulan = selectedOption.getAttribute('data-bayar-perbulan');
                console.log('ini berapa : ', bayarPerbulan);
                document.getElementById('bayar').value = bayarPerbulan ? 'Rp ' + bayarPerbulan : '';
            });
            // Function to format input as Indonesian Rupiah
            function formatRupiah(angka) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp ' + rupiah;
            }

            // On input change, format the input value
            document.getElementById('bayar').addEventListener('input', function(e) {
                var input = e.target.value;
                e.target.value = formatRupiah(input);
            });
        </script>
    @endsection
</x-app-layout>
