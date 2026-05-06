<?php $__env->startSection('title', 'Detail Estimasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

<!-- Header -->
<div>
    <h1 class="text-2xl font-bold">Detail Estimasi</h1>
    <p class="text-gray-500 text-sm">
        <?php echo e(\Carbon\Carbon::parse($estimation->date)->format('d M Y')); ?>

    </p>
</div>

<!-- Info -->
<div class="card max-w-md space-y-2">

    <p><strong>Customer:</strong> <?php echo e($estimation->customer->name); ?></p>

    <p>
        <strong>Status:</strong>
        <?php if($estimation->status == 'draft'): ?>
            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-lg">
                Draft
            </span>
        <?php else: ?>
            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-lg">
                Approved
            </span>
        <?php endif; ?>
    </p>

</div>

<!-- Form Update -->
<form action="<?php echo e(route('estimations.update', $estimation->id)); ?>" method="POST">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

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

                <?php $__currentLoopData = $estimation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="item-row border-b">

                    <!-- No -->
                    <td class="px-3 py-2"><?php echo e($i + 1); ?></td>

                    <!-- Barang -->
                    <td class="px-3 py-2">
                        <select name="items[<?php echo e($i); ?>][id]" class="item-select input-field">

                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"
                                data-price="<?php echo e($item->sell_price); ?>"
                                <?php echo e($row->item_id == $item->id ? 'selected' : ''); ?>>
                                <?php echo e($item->name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </td>

                    <!-- Harga -->
                    <td class="px-3 py-2">
                        <input type="number" class="price input-field w-28"
                               value="<?php echo e($row->price); ?>" readonly>
                    </td>

                    <!-- Qty -->
                    <td class="px-3 py-2">
                        <input type="number" name="items[<?php echo e($i); ?>][qty]"
                               value="<?php echo e($row->qty); ?>"
                               class="qty input-field w-20">
                    </td>

                    <!-- Subtotal -->
                    <td class="px-3 py-2">
                        <input type="number" class="subtotal input-field w-32"
                               value="<?php echo e($row->subtotal); ?>" readonly>
                    </td>

                    <!-- Aksi -->
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                                class="text-red-500">
                            ❌
                        </button>
                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="card max-w-md">

    <h3 class="text-sm text-gray-500">Total</h3>
    <h1 id="total" class="text-2xl font-bold">
        Rp <?php echo e(number_format($estimation->total, 0, ',', '.')); ?>

    </h1>

</div>

<!-- Action -->
<div class="flex justify-between items-center mt-4">

    <!-- LEFT -->
    <a href="<?php echo e(route('estimations.index')); ?>"
       class="text-gray-500 hover:underline text-sm">
        ← Kembali
    </a>

    <!-- RIGHT -->
    <div class="flex gap-2">

        <a href="<?php echo e(route('estimations.print', $estimation->id)); ?>"
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
let index = <?php echo e(count($estimation->items)); ?>;

function addItem() {
    let html = `
    <tr class="item-row border-b">

        <td class="px-3 py-2">#</td>

        <td class="px-3 py-2">
            <select name="items[${index}][id]" class="item-select input-field">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($item->id); ?>" data-price="<?php echo e($item->sell_price); ?>">
                    <?php echo e($item->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/estimations/show.blade.php ENDPATH**/ ?>