<?php $__env->startSection('title', 'Buat Estimasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

<form action="<?php echo e(route('estimations.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<!-- Customer -->
<div class="card max-w-md mb-8">
    <label class="text-sm mb-1 block">Customer</label>

    <select name="customer_id" class="input-field w-full">
        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<!-- Items -->
<div class="card mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold">Daftar Barang</h2>

        <button type="button" onclick="addItem()"
            class="btn-primary text-sm flex items-center gap-1">
            <i class="bi bi-plus"></i> Tambah
        </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-3 py-2 text-left">No</th>
                    <th class="px-3 py-2 text-left">Barang</th>
                    <th class="px-3 py-2 text-left">Qty</th>
                    <th class="px-3 py-2 text-left">Harga</th>
                    <th class="px-3 py-2 text-left">Subtotal</th>
                    <th class="px-3 py-2 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="items"></tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="card max-w-md mb-8">
    <h3 class="text-sm text-gray-500">Total</h3>
    <h1 id="total" class="text-2xl font-bold">Rp 0</h1>
</div>

<!-- Action -->
<div class="flex justify-end">
    <button class="btn-primary flex items-center gap-2">
        <i class="bi bi-save"></i> Simpan Estimasi
    </button>
</div>

</form>

</div>

<script>
let index = 0;

/* =========================
   TAMBAH ITEM
========================= */
function addItem() {

    let html = `
    <tr class="item-row border-b">

        <td class="no px-3 py-2">#</td>

        <td class="px-3 py-2">
            <select name="items[${index}][id]" class="item-select input-field w-full">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($item->id); ?>" data-price="<?php echo e($item->sell_price); ?>">
                    <?php echo e($item->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </td>

        <td class="px-3 py-2">
            <input type="number" name="items[${index}][qty]" value="1"
                   class="qty input-field w-20">
        </td>

        <td class="px-3 py-2">
            <input type="number" name="items[${index}][price]"
                   class="price input-field w-28" readonly>
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
    updateNumbering();
}

/* =========================
   HAPUS ITEM
========================= */
function removeRow(btn){
    btn.closest('tr').remove();
    calculateTotal();
    updateNumbering();
}

/* =========================
   AUTO HARGA
========================= */
document.addEventListener('change', e => {
    if(e.target.classList.contains('item-select')){
        let price = e.target.selectedOptions[0].dataset.price || 0;

        let row = e.target.closest('tr');

        row.querySelector('.price').value = price;

        calculateRow(row);
        calculateTotal();
    }
});

/* =========================
   AUTO QTY
========================= */
document.addEventListener('input', e => {
    if(e.target.classList.contains('qty')){
        let row = e.target.closest('tr');
        calculateRow(row);
        calculateTotal();
    }
});

/* =========================
   HITUNG ROW
========================= */
function calculateRow(row){
    let qty = row.querySelector('.qty').value || 0;
    let price = row.querySelector('.price').value || 0;

    row.querySelector('.subtotal').value = qty * price;
}

/* =========================
   HITUNG TOTAL
========================= */
function calculateTotal(){
    let total = 0;

    document.querySelectorAll('.subtotal').forEach(el=>{
        total += parseFloat(el.value) || 0;
    });

    document.getElementById('total').innerText =
        'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}

/* =========================
   NOMOR OTOMATIS
========================= */
function updateNumbering(){
    document.querySelectorAll('#items tr').forEach((row, i)=>{
        row.querySelector('.no').innerText = i + 1;
    });
}

/* =========================
   INIT
========================= */
function triggerAll(){
    document.querySelectorAll('.item-select').forEach(el=>{
        el.dispatchEvent(new Event('change'));
    });
}

window.onload = () => {
    addItem(); // auto 1 row
};
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/estimations/create.blade.php ENDPATH**/ ?>