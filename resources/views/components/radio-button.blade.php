<div class="form-group">
    <input type="radio" name="{{ $name }}" value="{{ $value }}"
        @if ($checked) checked @endif
        @if ($onclick) onclick="{{ $onclick }}" @endif>
    <label class="ml-1 text-sm">{{ $label }}</label>
</div>
