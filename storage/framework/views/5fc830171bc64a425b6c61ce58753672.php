<?php $__env->startSection('title', 'Buat Tagihan'); ?>

<?php $__env->startSection('content'); ?>

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

            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>"
                    <?php echo e(request('customer_id') == $c->id ? 'selected' : ''); ?>>
                    <?php echo e($c->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
    </form>

</div>

<!-- List Invoice -->
<?php if($invoices->count()): ?>

<form action="<?php echo e(route('bills.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<input type="hidden" name="customer_id" value="<?php echo e(request('customer_id')); ?>">

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

                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <!-- Checkbox -->
                    <td class="px-4 py-3">
                        <input type="checkbox"
                               name="invoice_ids[]"
                               value="<?php echo e($inv->id); ?>"
                               class="w-4 h-4">
                    </td>

                    <!-- No Invoice -->
                    <td class="px-4 py-3 font-medium">
                        <?php echo e($inv->invoice_no); ?>

                    </td>

                    <!-- Total -->
                    <td class="px-4 py-3 font-semibold text-blue-600 dark:text-blue-400">
                        Rp <?php echo e(number_format($inv->total, 0, ',', '.')); ?>

                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<?php else: ?>

<!-- Empty State -->
<?php if(request('customer_id')): ?>
<div class="card text-center py-8 text-gray-400">
    Tidak ada invoice unpaid untuk customer ini
</div>
<?php endif; ?>

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/bills/create.blade.php ENDPATH**/ ?>