<script src="{{ asset('js/focus-trap.js') }}"></script>
<div>
    {{-- <button @click="openModal('edit-pinjaman-modal-{{ $row->id }}')"
        class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </button>

    <x-custom-modal id="edit-pinjaman-modal-{{ $row->id }}" title="Edit Pinjaman">
        <form method="POST" action="{{ route('pinjaman.update', $row->id) }}" id="formEditPinjaman{{ $row->id }}">
            @csrf
            @method('put')
            <div class="form-group">
                <x-input-label for="member_id" :value="_('Member ID')"></x-input-label>
                <x-select-input id="member_id{{ $row->id }}" name="member_id" placeholder="Select member" required>
                    @foreach ($members as $member)
                        @if ($member->id == $row->member_id)
                            <option value="{{ $member->id }}" selected>{{ $member->nama_anggota }}</option>
                        @else
                            <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
                        @endif
                    @endforeach
                </x-select-input>
            </div>
            <div class="form-group mt-4">
                <x-input-label for="jumlah_pinjaman" :value="_('Jumlah Pinjaman')"></x-input-label>
                <x-text-input class="block mt-1 w-full" type="text" id="jumlah_pinjaman{{ $row->id }}"
                    name="jumlah_pinjaman" value="{{ $row->jumlah_pinjaman }}" required></x-text-input>
            </div>
            <div class="form-group mt-4">
                <x-input-label for="start_date" :value="_('Start Date')"></x-input-label>
                <x-text-input class="block mt-1 w-full" type="date" id="start_date{{ $row->id }}"
                    name="start_date" required value="{{ $row->start_date }}"></x-text-input>
            </div>
            <div class="form-group mt-4">
                <x-input-label for="tenor" :value="_('Tenor')"></x-input-label>
                <x-select-input id="tenor{{ $row->id }}" name="tenor" required>
                    <option value="10" {{ $row->tenor === 10 ? 'selected' : '' }}>10</option>
                </x-select-input>
            </div>
            <div class="form-group mt-4">
                <x-input-label for="total_bayar" :value="_('Total Bayar')"></x-input-label>
                <x-text-input class="bg-slate-100 block mt-1 w-full" type="text" id="total_bayar{{ $row->id }}"
                    name="total_bayar" readonly value="{{ $row->total_bayar }}"></x-text-input>
            </div>
            <div class="form-group mt-4">
                <x-input-label for="bayar_perbulan" :value="_('Bayar Perbulan')"></x-input-label>
                <x-text-input class="bg-slate-100 block mt-1 w-full" type="text"
                    id="bayar_perbulan{{ $row->id }}" name="bayar_perbulan" readonly
                    value="{{ $row->bayar_perbulan }}"></x-text-input>
            </div>
        </form>
        <x-slot name="footer">
            <x-primary-button onclick="document.getElementById('formEditPinjaman{{ $row->id }}').submit()">
                Save </x-primary-button>
        </x-slot>
    </x-custom-modal> --}}

    <button @click="openModal('delete-pinjaman-modal-{{ $row->id }}')"
        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
    </button>

    <x-custom-modal id="delete-pinjaman-modal-{{ $row->id }}" title="Delete Pinjaman">
        <form method="POST" action="{{ route('pinjaman.destroy', $row->id) }}"
            id="formDeletePinjaman{{ $row->id }}">
            @method('delete')
            @csrf
            <div class="form-group mt-2">
                <x-input-label :value="_('Member ID')"></x-input-label>{{ $row->member_id }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Jumlah Pinjaman')"></x-input-label>{{ $row->jumlah_pinjaman }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Start Date')"></x-input-label>{{ $row->start_date }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Tenor')"></x-input-label>{{ $row->tenor }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Total Bayar')"></x-input-label>{{ $row->total_bayar }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Bayar Perbulan')"></x-input-label>{{ $row->bayar_perbulan }}
            </div>
        </form>
        <div class="mt-5 border border-red-600 bg-red-100 rounded-md p-3">
            <p>Are you sure want to delete this pinjaman?
            </p>
            <strong>Once it deleted, it can't be undone!</strong>
        </div>
        <x-slot name="footer">
            <button onclick="document.getElementById('formDeletePinjaman{{ $row->id }}').submit()"
                class="focus:ring-2 focus:ring-red-600 focus:ring-offset-2 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Delete
            </button>
        </x-slot>
    </x-custom-modal>
</div>
<script>
    function submitFormWithValidation() {
        const form = document.getElementById('formEditPinjaman{{ $row->id }}');
        if (form.reportValidity()) {
            form.submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const jumlahPinjamanInput = document.getElementById('jumlah_pinjaman{{ $row->id }}');
        const tenorSelect = document.getElementById('tenor{{ $row->id }}');
        const totalBayarInput = document.getElementById('total_bayar{{ $row->id }}');
        const bayarPerbulanInput = document.getElementById('bayar_perbulan{{ $row->id }}');

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
