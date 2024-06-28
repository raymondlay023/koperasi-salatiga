<div>
    <button @click="openModal('edit-pinjaman-transaction-modal')"
        class="focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-600 border border-transparent rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-blue-400">
        Edit Pembayaran Pinjaman
    </button>
    <x-custom-modal id="edit-pinjaman-transaction-modal" title="Edit Pembayaran pinjaman">
        <form action="{{ route('pinjaman.transaction.update', $row->id) }}" method="POST">
            @method('PUT')
            @csrf
            {{-- <div class="form-group">
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
                <x-textarea placeholder="Catatan pembayaran" rows="5" />
            </div> --}}
        </form>
        <x-slot name="footer">
            <x-primary-button onclick="submitFormWithValidation()">
                Process Payment </x-primary-button>
        </x-slot>
    </x-custom-modal>
</div>
