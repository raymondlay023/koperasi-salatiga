<li class="relative px-6 py-3">
    @if ($isActive)
        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
    @endif
    <a class="inline-flex items-center w-full text-sm font-semibold {{ $isActive ? 'text-gray-800 dark:text-gray-100' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        href="{{ $href }}">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="{{ $svgPath }}"></path>
        </svg>
        <span class="ml-4">{{ $slot }}</span>
    </a>
</li>
