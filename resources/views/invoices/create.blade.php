@extends('layouts.app')

@section('title', 'Buat Invoice')

@section('content')

<div class="space-y-6">

<form action="{{ route('invoices.store') }}" method="POST">
@csrf

<input type="hidden" name="customer_id" value="{{ $estimation->customer_id }}">
<input type="hidden" name="estimation_id" value="{{ $estimation->id }}">

<!-- Info -->
<div class="card max-w-md space-y-2 mb-8">
    <p><strong>Customer:</strong> {{ $estimation->customer->name }}</p>
    <p><strong>Tanggal:</strong> {{ now()->format('d M Y') }}</p>
</div>

<!-- Table -->
<div class="card overflow-hidden mb-8">

    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Barang</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                    <th class="px-4 py-3 text-left">Qty</th>
                    <th class="px-4 py-3 text-left">Subtotal</th>
                </tr>
            </thead>

            <tbody>

                @foreach($estimation->items as $i => $row)
                <tr class="border-b border-gray-100 dark:border-gray-800">

                    <td class="px-4 py-3">{{ $i + 1 }}</td>

                    <td class="px-4 py-3 font-medium">
                        {{ $row->item->name }}
                    </td>

                    <td class="px-4 py-3">
                        Rp {{ number_format($row->price, 0, ',', '.') }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $row->qty }}
                    </td>

                    <td class="px-4 py-3">
                        Rp {{ number_format($row->subtotal, 0, ',', '.') }}
                    </td>

                    <!-- hidden (penting untuk backend) -->
                    <input type="hidden" name="items[{{ $i }}][id]" value="{{ $row->item_id }}">
                    <input type="hidden" name="items[{{ $i }}][qty]" value="{{ $row->qty }}">

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="card max-w-md mb-8">

    <h3 class="text-sm text-gray-500">Total</h3>
    <h1 class="text-2xl font-bold">
        Rp {{ number_format($estimation->total, 0, ',', '.') }}
    </h1>

    <input type="hidden" name="total" value="{{ $estimation->total }}">

</div>

<!-- Action -->
<div class="flex justify-end gap-3">

    <a href="{{ route('estimations.index') }}"
       class="text-gray-500 hover:underline text-sm">
        Batal
    </a>

    <button class="btn-primary flex items-center gap-2">
        <i class="bi bi-check-circle"></i>
        Simpan Invoice
    </button>

</div>

</form>

</div>

@endsection
