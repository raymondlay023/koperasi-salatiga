@if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (session()->has('error'))
    <x-alert type="error" :message="session('error')" />
@elseif ($errors->any())
    <x-alert type="error" :message="$errors->first()" />
@endif
