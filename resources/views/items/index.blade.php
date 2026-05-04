@extends('layouts.app')

@section('title', 'Barang')

@section('content')

<!-- Header -->
<div class="flex justify-end items-center mb-6">

    <a href="{{ route('items.create') }}" class="btn-primary flex gap-2 items-center">
        <i class="bi bi-plus"></i> Tambah
    </a>

</div>

<!-- Filter -->
<div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">

    <!-- Search -->
    <form method="GET" class="flex gap-2 w-full md:w-auto">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari barang..."
            class="input-field w-full md:w-72">

        <button class="btn-primary px-3">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <!-- Per Page -->
    <form method="GET" class="flex items-center gap-2">

        <input type="hidden" name="search" value="{{ request('search') }}">

        <label class="text-sm">Tampilkan</label>

        <select name="per_page"
            onchange="this.form.submit()"
            class="input-field">

            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>

        </select>

        <span class="text-sm">data</span>

    </form>

</div>

<!-- Table -->
<div id="table-data">
    @include('items.partials.table')
</div>

<!-- Pagination -->
@if(method_exists($items, 'links'))
<div class="mt-4">
    {{ $items->links() }}
</div>
@endif

@endsection
