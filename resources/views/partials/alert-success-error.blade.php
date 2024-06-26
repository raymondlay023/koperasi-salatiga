@if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
@elseif (session()->has('error'))
    <x-alert type="error" :message="session('error')" />
@endif
