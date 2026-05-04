@extends('layouts.app')

@section('title', 'Tagihan')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

<!-- Header -->
<div class="flex justify-end items-center">

    <a href="{{ route('bills.create') }}"
       class="btn-primary flex items-center gap-2">
        <i class="bi bi-receipt"></i>
        Buat Tagihan
    </a>

</div>

@if(session('error'))
    <div class="p-3 rounded-lg bg-red-500 text-white text-sm">
        {{ session('error') }}
    </div>
@endif

<!-- Table -->
<div class="card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[800px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Tagihan</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($bills as $index => $bill)
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 transition">

                    <!-- No -->
                    <td class="px-4 py-3">
                        {{ method_exists($bills, 'firstItem') ? $bills->firstItem() + $index : $loop->iteration }}
                    </td>

                    <!-- No Tagihan -->
                    <td class="px-4 py-3 font-medium">
                        {{ $bill->bill_no }}
                    </td>

                    <!-- Tanggal -->
                    <td class="px-4 py-3">
                        {{ \Carbon\Carbon::parse($bill->date)->format('d M Y') }}
                    </td>

                    <!-- Customer -->
                    <td class="px-4 py-3">
                        {{ $bill->customer->name ?? '-' }}
                    </td>

                    <!-- Total -->
                    <td class="px-4 py-3 font-semibold text-blue-600 dark:text-blue-400">
                        Rp {{ number_format($bill->total, 0, ',', '.') }}
                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3">
                        @if($bill->status == 'unpaid')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400">
                                Unpaid
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                                Paid
                            </span>
                        @endif
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-2">

                            <!-- Detail -->
                            <a href="{{ route('bills.show', $bill->id) }}"
                               class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('bills.destroy', $bill->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Yakin hapus tagihan ini?')"
                                    class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-400">
                        Belum ada tagihan
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- Pagination -->
@if(method_exists($bills, 'links'))
<div>
    {{ $bills->links() }}
</div>
@endif

</div>

@endsection
