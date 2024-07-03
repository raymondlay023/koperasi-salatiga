@extends('layouts.app')

@push('head')
    <script src="{{ asset('js/focus-trap.js') }}" defer></script>
@endpush

@section('content')
    <div class="pt-10 ps-10 container">
        <div class="justify-between items-center flex mb-6">
            <div>
                <span class="text-5xl font-bold">
                    Members
                </span>
            </div>
            <div>
                <button @click="openModal('create-member-modal')"
                    class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Create Item
                </button>
            </div>
        </div>

        <x-custom-modal id="create-member-modal" title="Create Item">
            <form method="POST" action="{{ route('member.store') }}" id="formCreateMember">
                @csrf
                <div class="form-group mt-4">
                    <x-input-label for="nama_anggota" :value="_('Nama Anggota')" />
                    <x-text-input id="nama_anggota" class="block mt-1 w-full" type="text" name="nama_anggota"
                        :value="old('nama_anggota')" autofocus required />
                    @error('nama_anggota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <x-input-label for="alamat_anggota" :value="_('Alamat Anggota')" />
                    <x-text-input id="alamat_anggota" class="block mt-1 w-full" type="text" name="alamat_anggota"
                        :value="old('alamat_anggota')" required />
                    @error('alamat_anggota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <x-input-label for="handphone" :value="_('Handphone')" />
                    <x-text-input :invalid="$errors->has('handphone')" errorMessage="Please enter a valid phone number." id="handphone"
                        class="block mt-1 w-full" type="text" name="handphone" :value="old('handphone')" required />
                    @error('handphone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <x-input-label for="tipe_member" :value="_('Tipe Member')" />
                    <x-select-input id="tipe_member" name="type_id" required placeholder="--Pilih tipe member--">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </x-select-input>
                    @error('type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <x-input-label for="keanggotaan" :value="_('Keanggotaan')" />
                    <x-checkbox-input id="is_penabung" name="keanggotaan[]" label="Penabung" />
                    <x-checkbox-input id="is_peminjam" name="keanggotaan[]" label="Peminjam" />
                    <div class="invalid-feedback text-red-500 mt-2 hidden" id="error-message">
                        Please select at least one membership type.
                    </div>
                </div>
            </form>
            <x-slot name="footer">
                <x-primary-button onclick="submitFormWithValidation()">
                    Submit </x-primary-button>
            </x-slot>
        </x-custom-modal>

        <livewire:koperasi-member-table />
    </div>
@endsection

@push('extraJs')
    <script>
        function submitFormWithValidation() {
            const form = document.getElementById('formCreateMember');
            const checkboxes = document.querySelectorAll('input[name="keanggotaan[]"]');
            let isChecked = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    isChecked = true;
                }
            });

            if (form.reportValidity()) {
                if (!isChecked) {
                    document.getElementById('error-message').classList.remove('hidden');
                } else {
                    document.getElementById('error-message').classList.add('hidden');
                    form.submit();
                }
            }

        }
    </script>
@endpush
