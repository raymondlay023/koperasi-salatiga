@props(['id', 'name', 'label', 'isChecked' => false])

<div>
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" {{ $isChecked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'form-check-input']) }}>
    <label for="{{ $id }}" class="form-check-label">{{ $label }}</label>
</div>
