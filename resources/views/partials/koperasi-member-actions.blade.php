<div>
    <button @click="openModal('edit-member-modal-{{ $row->id }}')"
        class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </button>

    <x-custom-modal id="edit-member-modal-{{ $row->id }}" title="Edit Member">
        <form method="POST" action="{{ route('member.update', $row->id) }}" id="formEditMember{{ $row->id }}">
            @csrf
            @method('put')
            <div class="form-group mt-4">
                <x-input-label for="nama_anggota" :value="_('Nama Anggota')" />
                <x-text-input id="nama_anggota" class="block mt-1 w-full" type="text" name="nama_anggota"
                    :value="$row->nama_anggota" autofocus required />
                @error('nama_anggota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-4">
                <x-input-label for="alamat_anggota" :value="_('Alamat Anggota')" />
                <x-text-input id="alamat_anggota" class="block mt-1 w-full" type="text" name="alamat_anggota"
                    :value="$row->alamat_anggota" required />
                @error('alamat_anggota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-4">
                <x-input-label for="handphone" :value="_('Handphone')" />
                <x-text-input :invalid="$errors->has('handphone')" errorMessage="Please enter a valid phone number." id="handphone"
                    class="block mt-1 w-full" type="text" name="handphone" :value="$row->handphone" required />
                @error('handphone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-4">
                <x-input-label for="tipe_member" :value="_('Tipe Member')" />
                <x-select-input id="tipe_member" name="type_id" required placeholder="--Pilih tipe member--">
                    @foreach ($types as $type)
                        @if ($type->id === $row->type_id)
                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                        @else
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endif
                    @endforeach
                </x-select-input>
                @error('type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-4">
                <x-input-label for="keanggotaan" :value="_('Keanggotaan')" />
                <x-checkbox-input id="is_penabung" name="keanggotaan[is_penabung]" label="Penabung"
                    isChecked="{{ $row->is_penabung === 'Ya' }}" />
                <x-checkbox-input id="is_peminjam" name="keanggotaan[is_peminjam]" label="Peminjam"
                    isChecked="{{ $row->is_peminjam === 'Ya' }}" />
                <div class="invalid-feedback text-red-500 mt-2 hidden" id="error-message">
                    Please select at least one membership type.
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <x-primary-button onclick="document.getElementById('formEditMember{{ $row->id }}').submit()">
                Save </x-primary-button>
        </x-slot>
    </x-custom-modal>

    <button @click="openModal('delete-member-modal-{{ $row->id }}')"
        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
    </button>

    <x-custom-modal id="delete-member-modal-{{ $row->id }}" title="Delete Member">
        <form method="POST" action="{{ route('member.destroy', $row->id) }}"
            id="formDeleteMember{{ $row->id }}">
            @method('delete')
            @csrf
            <div class="form-group mt-2">
                <x-input-label for="keanggotaan" :value="_('Nama Anggota')" /> {{ $row->nama_anggota }}
            </div>
            <div class="form-group mt-2">
                <x-input-label for="keanggotaan" :value="_('Alamat Anggota')" /> {{ $row->alamat_anggota }}
            </div>
            <div class="form-group mt-2">
                <x-input-label for="keanggotaan" :value="_('Handphone')" /> {{ $row->handphone }}
            </div>
            <div class="form-group mt-2">
                <x-input-label for="keanggotaan" :value="_('Tipe Member')" /> {{ $row->type->name }}
            </div>
            <div class="form-group mt-2">
                <x-input-label for="is_penabung" :value="_('Penabung?')" /> {{ $row->is_penabung }}
            </div>
            <div class="form-group mt-2">
                <x-input-label for="is_peminjam" :value="_('Peminjam?')" /> {{ $row->is_peminjam }}
            </div>
        </form>
        <x-slot name="footer">
            <!-- Footer content goes here -->
            <button onclick="document.getElementById('formDeleteMember{{ $row->id }}').submit()"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Delete
            </button>
        </x-slot>
    </x-custom-modal>
</div>
