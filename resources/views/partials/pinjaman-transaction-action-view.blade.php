<div>
    {{-- <button @click="openModal('edit-pinjaman-transaction-modal-{{ $row->id }}')"
        class="focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-emerald-600 border border-transparent rounded-lg active:bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:shadow-blue-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </button>
    <x-custom-modal id="edit-pinjaman-transaction-modal-{{ $row->id }}" title="Edit Pembayaran pinjaman">
        <form action="{{ route('pinjaman.transaction.update', $row->id) }}" method="POST"
            id="formEditPinjamanTransaction{{ $row->id }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <x-input-label for="pinjaman_id" :value="_('Choose Member')" />
                <x-select-input name="pinjaman_id" id="pinjaman_id" placeholder="Select Member">
                    @foreach ($pinjamans->where('is_lunas', 0) as $pinjaman)
                        @if ($row->pinjaman_id === $pinjaman->id)
                            <option value="{{ $pinjaman->id }}" data-bayar-perbulan="{{ $pinjaman->bayar_perbulan }}"
                                selected>
                                {{ $pinjaman->id }} - {{ $pinjaman->memberpinjaman->nama_anggota }}</option>
                        @else
                            <option value="{{ $pinjaman->id }}" data-bayar-perbulan="{{ $pinjaman->bayar_perbulan }}">
                                {{ $pinjaman->id }} - {{ $pinjaman->memberpinjaman->nama_anggota }}</option>
                        @endif)
                    @endforeach
                </x-select-input>
            </div>
            <div class="form-group mt-3">
                <x-input-label for="bayar" :value="_('Bayar (Rp)')" />
                <x-text-input type="text" name="bayar" id="bayar" placeholder="Enter amount in Rp"
                    class="block w-full mt-1" :value="$row->bayar"></x-text-input>
            </div>
            <div class="form-group mt-3">
                <x-input-label for="remark" :value="_('Remark')" />
                <x-textarea placeholder="Catatan pembayaran" rows="5"> {{ $row->remark }} </x-textarea>
            </div>
        </form>
        <x-slot name="footer">
            <x-primary-button
                onclick="document.getElementById('formEditPinjamanTransaction{{ $row->id }}').submit()">
                Save </x-primary-button>
        </x-slot>
    </x-custom-modal> --}}
    <button @click="openModal('delete-pinjaman-transaction-modal-{{ $row->id }}')"
        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
    </button>
    <x-custom-modal id="delete-pinjaman-transaction-modal-{{ $row->id }}" title="Delete Pembayaran pinjaman">
        <form action="{{ route('pinjaman.transaction.destroy', $row->id) }}" method="POST"
            id="formDeletePinjamanTransaction{{ $row->id }}">
            @method('DELETE')
            @csrf
            <div class="form-group">
                <x-input-label for="pinjaman_id" :value="_('Choose Member')" /> {{ $row->peminjam }}

            </div>
            <div class="form-group mt-3">
                <x-input-label for="bayar" :value="_('Bayar (Rp)')" /> {{ $row->bayar }}
            </div>
            <div class="form-group mt-3">
                <x-input-label for="remark" :value="_('Remark')" /> {{ $row->remark }}
            </div>
        </form>
        <x-slot name="footer">
            <x-primary-button
                onclick="document.getElementById('formDeletePinjamanTransaction{{ $row->id }}').submit()">
                Delete </x-primary-button>
        </x-slot>
    </x-custom-modal>
</div>
