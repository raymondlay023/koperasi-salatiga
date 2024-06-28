@props(['disabled' => false, 'placeholder' => 'Select an option'])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-300 w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray rounded',
]) !!}>
    <option value="" selected disabled>{{ $placeholder }}</option>
    {{ $slot }}
</select>
