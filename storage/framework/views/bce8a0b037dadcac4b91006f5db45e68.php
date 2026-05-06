<?php $__env->startSection('title', 'Detail Invoice'); ?>

<?php $__env->startSection('content'); ?>



<!-- Header -->
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-2xl font-bold">
            Invoice <?php echo e($invoice->invoice_no); ?>

        </h1>
        <p class="text-sm text-gray-500">
            Detail transaksi pelanggan
        </p>
    </div>

    <!-- Status -->
    <div>
        <?php if($invoice->status == 'unpaid'): ?>
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
<div class="card grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

    <div>
        <p class="text-sm text-gray-500">Customer</p>
        <p class="font-semibold">
            <?php echo e($invoice->customer->name ?? '-'); ?>

        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500">Tanggal</p>
        <p class="font-semibold">
            <?php echo e(\Carbon\Carbon::parse($invoice->date)->format('d M Y')); ?>

        </p>
    </div>

</div>

<!-- Table -->
<div class="card overflow-hidden mb-6">

    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Barang</th>
                    <th class="px-4 py-3 text-left">Qty</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                    <th class="px-4 py-3 text-left">Subtotal</th>
                </tr>
            </thead>

            <tbody>

                <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <td class="px-4 py-3">
                        <?php echo e($index + 1); ?>

                    </td>

                    <td class="px-4 py-3 font-medium">
                        <?php echo e($it->name); ?>

                    </td>

                    <td class="px-4 py-3">
                        <?php echo e($it->qty); ?>

                    </td>

                    <td class="px-4 py-3">
                        Rp <?php echo e(number_format($it->price,0,',','.')); ?>

                    </td>

                    <td class="px-4 py-3 font-semibold">
                        Rp <?php echo e(number_format($it->subtotal,0,',','.')); ?>

                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    </div>

</div>

<!-- Total -->
<div class="flex justify-end mb-6">

    <div class="card w-full md:max-w-sm text-right">
        <p class="text-sm text-gray-500">Total</p>
        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">
            Rp <?php echo e(number_format($invoice->total,0,',','.')); ?>

        </h1>
    </div>

</div>

<!-- Action -->
<div class="flex justify-end gap-2 mb-6">

    <a href="<?php echo e(route('invoices.index')); ?>"
       class="px-3 py-1 text-sm rounded-full bg-blue-100 text-black-600 dark:blue-500/10 dark:text-blue-400">
        Kembali
    </a>
    <a href="<?php echo e(route('invoices.print', $invoice->id)); ?>"
       class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400">
        <i class="bi bi-printer"></i> Print
    </a>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/invoices/show.blade.php ENDPATH**/ ?>