<?php $__env->startSection('title', 'Buat Invoice'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

<form action="<?php echo e(route('invoices.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<input type="hidden" name="customer_id" value="<?php echo e($estimation->customer_id); ?>">
<input type="hidden" name="estimation_id" value="<?php echo e($estimation->id); ?>">

<!-- Info -->
<div class="card max-w-md space-y-2 mb-8">
    <p><strong>Customer:</strong> <?php echo e($estimation->customer->name); ?></p>
    <p><strong>Tanggal:</strong> <?php echo e(now()->format('d M Y')); ?></p>
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

                <?php $__currentLoopData = $estimation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-gray-100 dark:border-gray-800">

                    <td class="px-4 py-3"><?php echo e($i + 1); ?></td>

                    <td class="px-4 py-3 font-medium">
                        <?php echo e($row->item->name); ?>

                    </td>

                    <td class="px-4 py-3">
                        Rp <?php echo e(number_format($row->price, 0, ',', '.')); ?>

                    </td>

                    <td class="px-4 py-3">
                        <?php echo e($row->qty); ?>

                    </td>

                    <td class="px-4 py-3">
                        Rp <?php echo e(number_format($row->subtotal, 0, ',', '.')); ?>

                    </td>

                    <!-- hidden (penting untuk backend) -->
                    <input type="hidden" name="items[<?php echo e($i); ?>][id]" value="<?php echo e($row->item_id); ?>">
                    <input type="hidden" name="items[<?php echo e($i); ?>][qty]" value="<?php echo e($row->qty); ?>">

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="card max-w-md mb-8">

    <h3 class="text-sm text-gray-500">Total</h3>
    <h1 class="text-2xl font-bold">
        Rp <?php echo e(number_format($estimation->total, 0, ',', '.')); ?>

    </h1>

    <input type="hidden" name="total" value="<?php echo e($estimation->total); ?>">

</div>

<!-- Action -->
<div class="flex justify-end gap-3">

    <a href="<?php echo e(route('estimations.index')); ?>"
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/invoices/create.blade.php ENDPATH**/ ?>