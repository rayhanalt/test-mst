@if (session()->has('success'))
    <button class="btn-success btn-sm btn">
        {{ session('success') }}
    </button>
@endif
@if (session()->has('failed'))
    <button class="btn-error btn-sm btn">
        {{ session('failed') }}
    </button>
@endif
