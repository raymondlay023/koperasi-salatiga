<div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer transition-colors duration-200">
    <div
        class="p-3 mr-4 text-{{ $iconColor }}-500 bg-{{ $iconColor }}-100 rounded-full dark:text-{{ $iconColor }}-100 dark:bg-{{ $iconColor }}-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="{{ $svgPath }}"></path>
        </svg>
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
            {{ $title }}
        </p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $value }}
        </p>
    </div>
</div>
