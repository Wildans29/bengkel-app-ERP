@extends('layouts.app')

@section('title', 'Detail Estimasi')

@section('content')

<div class="space-y-6">

<!-- Header -->
<div>
    <h1 class="text-2xl font-bold">Detail Estimasi</h1>
    <p class="text-gray-500 text-sm">
        {{ \Carbon\Carbon::parse($estimation->date)->format('d M Y') }}
    </p>
</div>

<!-- Info -->
<div class="card max-w-md space-y-2">

    <p><strong>Customer:</strong> {{ $estimation->customer->name }}</p>

    <p>
        <strong>Status:</strong>
        @if($estimation->status == 'draft')
            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-lg">
                Draft
            </span>
        @else
            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-lg">
                Approved
            </span>
        @endif
    </p>

</div>

<!-- Form Update -->
<form action="{{ route('estimations.update', $estimation->id) }}" method="POST">
@csrf
@method('PUT')

<div class="card">

    <div class="flex justify-between mb-4">
        <h2 class="font-semibold">Daftar Barang</h2>
        <button type="button" onclick="addItem()" class="btn-primary text-sm">
            + Tambah
        </button>
    </div>

    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-3 py-2 text-left">No</th>
                    <th class="px-3 py-2 text-left">Barang</th>
                    <th class="px-3 py-2 text-left">Harga</th>
                    <th class="px-3 py-2 text-left">Qty</th>
                    <th class="px-3 py-2 text-left">Subtotal</th>
                    <th class="px-3 py-2 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="items">

                @foreach($estimation->items as $i => $row)
                <tr class="item-row border-b">

                    <!-- No -->
                    <td class="px-3 py-2">{{ $i + 1 }}</td>

                    <!-- Barang -->
                    <td class="px-3 py-2">
                        <select name="items[{{ $i }}][id]" class="item-select input-field">

                            @foreach($items as $item)
                            <option value="{{ $item->id }}"
                                data-price="{{ $item->sell_price }}"
                                {{ $row->item_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach

                        </select>
                    </td>

                    <!-- Harga -->
                    <td class="px-3 py-2">
                        <input type="number" class="price input-field w-28"
                               value="{{ $row->price }}" readonly>
                    </td>

                    <!-- Qty -->
                    <td class="px-3 py-2">
                        <input type="number" name="items[{{ $i }}][qty]"
                               value="{{ $row->qty }}"
                               class="qty input-field w-20">
                    </td>

                    <!-- Subtotal -->
                    <td class="px-3 py-2">
                        <input type="number" class="subtotal input-field w-32"
                               value="{{ $row->subtotal }}" readonly>
                    </td>

                    <!-- Aksi -->
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                                class="text-red-500">
                            ❌
                        </button>
                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="card max-w-md">

    <h3 class="text-sm text-gray-500">Total</h3>
    <h1 id="total" class="text-2xl font-bold">
        Rp {{ number_format($estimation->total, 0, ',', '.') }}
    </h1>

</div>

<!-- Action -->
<div class="flex justify-between items-center mt-4">

    <!-- LEFT -->
    <a href="{{ route('estimations.index') }}"
       class="text-gray-500 hover:underline text-sm">
        ← Kembali
    </a>

    <!-- RIGHT -->
    <div class="flex gap-2">

        <a href="{{ route('estimations.print', $estimation->id) }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg flex items-center gap-2 hover:bg-gray-700">
            <i class="bi bi-printer"></i> Cetak
        </a>

        <button type="submit"
            class="btn-primary flex items-center gap-2">
            <i class="bi bi-save"></i> Update
        </button>

    </div>

</div>

</form>

</div>

<script>
let index = {{ count($estimation->items) }};

function addItem() {
    let html = `
    <tr class="item-row border-b">

        <td class="px-3 py-2">#</td>

        <td class="px-3 py-2">
            <select name="items[${index}][id]" class="item-select input-field">
                @foreach($items as $item)
                <option value="{{ $item->id }}" data-price="{{ $item->sell_price }}">
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
        </td>

        <td class="px-3 py-2">
            <input type="number" class="price input-field w-28" readonly>
        </td>

        <td class="px-3 py-2">
            <input type="number" name="items[${index}][qty]" value="1"
                   class="qty input-field w-20">
        </td>

        <td class="px-3 py-2">
            <input type="number" class="subtotal input-field w-32" readonly>
        </td>

        <td class="px-3 py-2 text-right">
            <button type="button" onclick="removeRow(this)" class="text-red-500">❌</button>
        </td>

    </tr>`;

    document.getElementById('items').insertAdjacentHTML('beforeend', html);
    index++;
    triggerAll();
}

function removeRow(btn){
    btn.closest('tr').remove();
    calculateTotal();
}

document.addEventListener('change', e => {
    if(e.target.classList.contains('item-select')){
        let price = e.target.selectedOptions[0].dataset.price;
        let row = e.target.closest('tr');
        row.querySelector('.price').value = price;
        calculateRow(row);
        calculateTotal();
    }
});

document.addEventListener('input', e => {
    if(e.target.classList.contains('qty')){
        let row = e.target.closest('tr');
        calculateRow(row);
        calculateTotal();
    }
});

function calculateRow(row){
    let qty = row.querySelector('.qty').value || 0;
    let price = row.querySelector('.price').value || 0;
    row.querySelector('.subtotal').value = qty * price;
}

function calculateTotal(){
    let total = 0;

    document.querySelectorAll('.subtotal').forEach(el=>{
        total += parseFloat(el.value) || 0;
    });

    document.getElementById('total').innerText =
        'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}

function triggerAll(){
    document.querySelectorAll('.item-select').forEach(el=>{
        el.dispatchEvent(new Event('change'));
    });
}

window.onload = triggerAll;
</script>

@endsection
