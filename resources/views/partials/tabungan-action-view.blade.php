<div>
    <button @click="openModal('delete-tabungan-modal-{{ $row->id }}')"
        class="mt-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
    </button>

    <x-custom-modal id="delete-tabungan-modal-{{ $row->id }}" title="Delete Tabungan">
        <form method="POST" action="{{ route('tabungan.destroy', $row->id) }}"
            id="formDeleteTabungan{{ $row->id }}">
            @method('delete')
            @csrf
            <div class="form-group mt-2">
                <x-input-label :value="_('Member Name')"></x-input-label>{{ $row->member_name }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Handphone')"></x-input-label>{{ $row->handphone }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Saldo')"></x-input-label>{{ $row->saldo }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Status')"></x-input-label>{{ $row->status }}
            </div>

            <div class="form-group mt-2">
                <x-input-label :value="_('Created By')"></x-input-label>{{ $row->created_by }}
            </div>

        </form>
        <div class="mt-5 border border-red-600 bg-red-100 rounded-md p-3">
            <p>Are you sure want to delete this tabungan?
            </p>
            <strong>Once it deleted, it can't be undone!</strong>
        </div>
        <x-slot name="footer">
            <button onclick="document.getElementById('formDeleteTabungan{{ $row->id }}').submit()"
                class="focus:ring-2 focus:ring-red-600 focus:ring-offset-2 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Delete
            </button>
        </x-slot>
    </x-custom-modal>
</div>
