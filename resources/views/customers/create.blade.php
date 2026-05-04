@extends('layouts.app')

@section('title', 'Tambah Customer')

@section('content')

<!-- Form -->
<div class="card max-w-2xl">

    <form action="{{ route('customers.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="name"
                value="{{ old('name') }}"
                class="input-field w-full"
                placeholder="Masukkan nama">

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email"
                value="{{ old('email') }}"
                class="input-field w-full"
                placeholder="Masukkan email">

            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Telepon -->
        <div>
            <label class="block text-sm mb-1">Telepon</label>
            <input type="text" name="phone"
                value="{{ old('phone') }}"
                class="input-field w-full"
                placeholder="Masukkan nomor">

            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-sm mb-1">Alamat</label>
            <textarea name="address"
                rows="3"
                class="input-field w-full"
                placeholder="Masukkan alamat">{{ old('address') }}</textarea>

            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">

            <!-- Back -->
            <a href="{{ route('customers.index') }}"
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
                    Simpan
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
