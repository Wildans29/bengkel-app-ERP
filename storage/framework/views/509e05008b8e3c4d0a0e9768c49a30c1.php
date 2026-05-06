<?php $__env->startSection('title', 'Invoice'); ?>

<?php $__env->startSection('content'); ?>



<!-- Table -->
<div class="card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[800px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Invoice</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 transition">

                    <!-- No -->
                    <td class="px-4 py-3">
                        <?php echo e(method_exists($invoices, 'firstItem') ? $invoices->firstItem() + $index : $loop->iteration); ?>

                    </td>

                    <!-- No Invoice -->
                    <td class="px-4 py-3 font-medium">
                        <?php echo e($inv->invoice_no ?? '-'); ?>

                    </td>

                    <!-- Tanggal -->
                    <td class="px-4 py-3">
                        <?php echo e(\Carbon\Carbon::parse($inv->date)->format('d M Y')); ?>

                    </td>

                    <!-- Customer -->
                    <td class="px-4 py-3">
                        <?php echo e($inv->customer->name ?? '-'); ?>

                    </td>

                    <!-- Total -->
                    <td class="px-4 py-3 font-semibold text-blue-600 dark:text-blue-400">
                        Rp <?php echo e(number_format($inv->total, 0, ',', '.')); ?>

                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3">
                        <?php if($inv->status == 'unpaid'): ?>
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400">
                                Unpaid
                            </span>
                        <?php else: ?>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                                Paid
                            </span>
                        <?php endif; ?>
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-2">

                            <!-- Detail -->
                            <a href="<?php echo e(route('invoices.show', $inv->id)); ?>"
                               class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Delete -->
                            <form action="<?php echo e(route('invoices.destroy', $inv->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button onclick="return confirm('Yakin hapus invoice ini?')"
                                    class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-400">
                        Belum ada invoice
                    </td>
                </tr>
                <?php endif; ?>

            </tbody>

        </table>

    </div>



<!-- Pagination -->
<?php if(method_exists($invoices, 'links')): ?>
<div>
    <?php echo e($invoices->links()); ?>

</div>
<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/invoices/index.blade.php ENDPATH**/ ?>