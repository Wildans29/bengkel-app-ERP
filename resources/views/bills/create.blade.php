@extends('layouts.app')

@section('title', 'Buat Tagihan')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

<!-- Header -->
<div>
    <h1 class="text-2xl font-bold">Buat Tagihan</h1>
    <p class="text-sm text-gray-500">Pilih invoice untuk dijadikan tagihan</p>
</div>

<!-- Pilih Customer -->
<div class="card max-w-md">

    <form method="GET">
        <label class="text-sm mb-2 block">Customer</label>

        <select name="customer_id"
            onchange="this.form.submit()"
            class="input-field w-full">

            <option value="">Pilih Customer</option>

            @foreach($customers as $c)
                <option value="{{ $c->id }}"
                    {{ request('customer_id') == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach

        </select>
    </form>

</div>

<!-- List Invoice -->
@if($invoices->count())

<form action="{{ route('bills.store') }}" method="POST">
@csrf

<input type="hidden" name="customer_id" value="{{ request('customer_id') }}">

<div class="card overflow-hidden mb-6">

    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">Pilih</th>
                    <th class="px-4 py-3 text-left">No Invoice</th>
                    <th class="px-4 py-3 text-left">Total</th>
                </tr>
            </thead>

            <tbody>

                @foreach($invoices as $inv)
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <!-- Checkbox -->
                    <td class="px-4 py-3">
                        <input type="checkbox"
                               name="invoice_ids[]"
                               value="{{ $inv->id }}"
                               class="w-4 h-4">
                    </td>

                    <!-- No Invoice -->
                    <td class="px-4 py-3 font-medium">
                        {{ $inv->invoice_no }}
                    </td>

                    <!-- Total -->
                    <td class="px-4 py-3 font-semibold text-blue-600 dark:text-blue-400">
                        Rp {{ number_format($inv->total, 0, ',', '.') }}
                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- Action -->
<div class="flex justify-end">

    <button type="submit"
        class="btn-primary flex items-center gap-2 px-6">
        <i class="bi bi-receipt"></i>
        Buat Tagihan
    </button>

</div>

</form>

@else

<!-- Empty State -->
@if(request('customer_id'))
<div class="card text-center py-8 text-gray-400">
    Tidak ada invoice unpaid untuk customer ini
</div>
@endif

@endif

</div>

@endsection
