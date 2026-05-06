<?php $__env->startSection('title', 'Detail Tagihan'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-5xl mx-auto space-y-6">

<!-- Header -->
<div class="flex justify-between items-center">

    <!-- Status -->
    <div>
        <?php if($bill->status == 'unpaid'): ?>
            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400">
                Unpaid
            </span>
        <?php else: ?>
            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                Paid
            </span>
        <?php endif; ?>
    </div>

</div>

<!-- Info -->
<div class="card grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <p class="text-sm text-gray-500">Customer</p>
        <p class="font-semibold">
            <?php echo e($bill->customer->name ?? '-'); ?>

        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500">Tanggal</p>
        <p class="font-semibold">
            <?php echo e(\Carbon\Carbon::parse($bill->date)->format('d M Y')); ?>

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

                <?php $__empty_1 = true; $__currentLoopData = $bill->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <td class="px-4 py-3">
                        <?php echo e($index + 1); ?>

                    </td>

                    <td class="px-4 py-3 font-medium">
                        <?php echo e($inv->invoice_no); ?>

                    </td>

                    <td class="px-4 py-3 font-semibold text-blue-600 dark:text-blue-400">
                        Rp <?php echo e(number_format($inv->total, 0, ',', '.')); ?>

                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-400">
                        Tidak ada invoice dalam tagihan ini
                    </td>
                </tr>
                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="flex justify-end">

    <div class="card w-full md:max-w-sm text-right">
        <p class="text-sm text-gray-500">Total Tagihan</p>
        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">
            Rp <?php echo e(number_format($bill->total, 0, ',', '.')); ?>

        </h1>
    </div>

</div>

<!-- Action -->
<div class="flex justify-between items-center mt-4">

    <!-- LEFT -->
    <a href="<?php echo e(route('bills.index')); ?>"
       class="text-gray-500 hover:underline text-sm">
        ← Kembali
    </a>

    <!-- RIGHT -->
    <div class="flex gap-2">

        <a href="<?php echo e(route('bills.print', $bill->id)); ?>"
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/bills/show.blade.php ENDPATH**/ ?>