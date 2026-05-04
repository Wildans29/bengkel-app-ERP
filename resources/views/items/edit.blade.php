@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<!-- Form -->
<div class="card max-w-2xl">

    <form method="POST" action="{{ route('items.update', $item->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label class="block text-sm mb-1">Nama Barang</label>
            <input type="text" name="name"
                value="{{ old('name', $item->name) }}"
                class="input-field w-full"
                placeholder="Masukkan nama barang"
                required>

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stok -->
        <div>
            <label class="block text-sm mb-1">Stok</label>
            <input type="number" name="stock"
                value="{{ old('stock', $item->stock) }}"
                class="input-field w-full"
                min="0"
                required>

            @error('stock')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Beli -->
        <div>
            <label class="block text-sm mb-1">Harga Beli</label>
            <input type="number" name="buy_price"
                value="{{ old('buy_price', $item->buy_price) }}"
                class="input-field w-full"
                min="0"
                required>

            @error('buy_price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Jual -->
        <div>
            <label class="block text-sm mb-1">Harga Jual</label>
            <input type="number" name="sell_price"
                value="{{ old('sell_price', $item->sell_price) }}"
                class="input-field w-full"
                min="0"
                required>

            @error('sell_price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">

            <!-- Back -->
            <a href="{{ route('items.index') }}"
               class="text-gray-500 hover:underline text-sm">
                ← Kembali
            </a>

            <!-- Buttons -->
            <div class="flex gap-2">

                <button type="reset"
                    class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 rounded-lg">
                    Reset
                </button>

                <button type="submit"
                    class="btn-primary flex items-center gap-2">
                    <i class="bi bi-save"></i>
                    Update
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
