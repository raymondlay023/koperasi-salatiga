@extends('layouts.app')

@section('content')
    <div class="ps-10 pt-10 container">

        <div class="justify-between flex">
            <div>
                <p>
                    <a href="{{ route('users.index') }}" class="text-blue-800"> Users </a> > <span
                        class="text-gray-500">List</span>
                </p>
                <p class="text-5xl font-bold">
                    Users
                </p>
            </div>
            <div>
                <button @click="openModal('create-user-modal')"
                    class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Create User
                </button>
            </div>
        </div>

        <x-custom-modal id="create-user-modal" title="Create User">
            <form method="POST" action="{{ route('users.store') }}" id="formCreateUser">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="mt-4">
                    <x-input-label for="role_id" :value="__('Role')" />
                    <x-select-input id="role_id" class="block mt-1 w-full" type="text" name="role_id" :value="old('role_id')"
                        required placeholder="Select role">
                        @foreach ($roles as $role)
                            @if ($role->role_name != 'Owner')
                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endif
                        @endforeach
                    </x-select-input>
                    {{-- <x-text-input id="role_id" class="block mt-1 w-full" type="text" name="role_id" :value="old('role_id')"
                        required /> --}}
                    <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-slot name="footer">
                    <x-primary-button onclick="submitFormWithValidation()">
                        Submit </x-primary-button>
                </x-slot>
            </form>
        </x-custom-modal>

        <div class="py-10">
            <livewire:user-table />
        </div>
    </div>
@endsection
@push('extraJs')
    <script>
        function submitFormWithValidation() {
            const form = document.getElementById('formCreateUser');
            if (form.reportValidity()) {
                form.submit();
            }
        }
    </script>
@endpush
