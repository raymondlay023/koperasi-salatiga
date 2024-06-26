@props(['type' => 'error', 'message'])

@php
    $alertClasses = [
        'success' => 'bg-green-100 border border-green-400 text-green-700',
        'error' => 'bg-red-100 border border-red-400 text-red-700',
    ];

    $iconClasses = [
        'success' => 'text-green-600',
        'error' => 'text-red-600',
    ];

    $icons = [
        'success' =>
            '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />',
        'error' =>
            '<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />',
    ];
@endphp

<div x-data="{ show: true }" x-show="show"
    class="{{ $alertClasses[$type] }} px-4 py-3 rounded relative flex items-center m-10" role="alert">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="h-6 w-6 {{ $iconClasses[$type] }}">
            {!! $icons[$type] !!}
        </svg>
    </div>
    <div class="ms-4">
        <strong class="font-bold block">{{ ucfirst($type) }}!</strong>
        <span class="block sm:inline">{{ $message }}</span>
    </div>
</div>
{{-- Not working, last checked: 25/06/24 --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const alertElement = document.querySelector('.alert-component');
            if (alertElement) {
                alertElement.style.transition = 'opacity 1s';
                alertElement.style.opacity = 0;
                setTimeout(() => alertElement.remove(),
                    1000); // Wait for the transition to complete before removing the element
            }
        }, 3000); // 3 seconds
    });
</script>
