@extends('layouts.app')

@section('title', 'Detail Tagihan')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

<!-- Header -->
<div class="flex justify-between items-center">

    <!-- Status -->
    <div>
        @if($bill->status == 'unpaid')
            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400">
                Unpaid
            </span>
        @else
            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                Paid
            </span>
        @endif
    </div>

</div>

<!-- Info -->
<div class="card grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <p class="text-sm text-gray-500">Customer</p>
        <p class="font-semibold">
            {{ $bill->customer->name ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500">Tanggal</p>
        <p class="font-semibold">
            {{ \Carbon\Carbon::parse($bill->date)->format('d M Y') }}
        </p>
    </div>

</div>

<!-- Table Invoice -->
<div class="card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[600px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Invoice</th>
                    <th class="px-4 py-3 text-left">Total</th>
                </tr>
            </thead>

            <tbody>

                @forelse($bill->invoices as $index => $inv)
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <td class="px-4 py-3">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-4 py-3 font-medium">
                        {{ $inv->invoice_no }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-blue-600 dark:text-blue-400">
                        Rp {{ number_format($inv->total, 0, ',', '.') }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-400">
                        Tidak ada invoice dalam tagihan ini
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="flex justify-end">

    <div class="card w-full md:max-w-sm text-right">
        <p class="text-sm text-gray-500">Total Tagihan</p>
        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">
            Rp {{ number_format($bill->total, 0, ',', '.') }}
        </h1>
    </div>

</div>

<!-- Action -->
<div class="flex justify-between items-center mt-4">

    <!-- LEFT -->
    <a href="{{ route('bills.index') }}"
       class="text-gray-500 hover:underline text-sm">
        ← Kembali
    </a>

    <!-- RIGHT -->
    <div class="flex gap-2">

        <a href="{{ route('bills.print', $bill->id) }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg flex items-center gap-2 hover:bg-gray-700">
            <i class="bi bi-printer"></i> Cetak
        </a>

        <button type="submit"
            class="btn-primary flex items-center gap-2">
            <i class="bi bi-save"></i> Update
        </button>

    </div>

</div>


</div>

@endsection
