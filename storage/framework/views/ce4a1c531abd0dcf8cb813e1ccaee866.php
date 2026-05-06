<?php $__env->startSection('title', 'Estimasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex justify-end items-center mb-6">

    <a href="<?php echo e(route('estimations.create')); ?>"
       class="btn-primary flex items-center gap-2">
        <i class="bi bi-plus"></i> Buat Estimasi
    </a>

</div>

<div class="card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $estimations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <td class="px-4 py-3"><?php echo e($i + 1); ?></td>

                    <td class="px-4 py-3">
                        <?php echo e(\Carbon\Carbon::parse($e->date)->format('d-m-Y')); ?>

                    </td>

                    <td class="px-4 py-3 font-medium">
                        <?php echo e($e->customer->name ?? '-'); ?>

                    </td>

                    <td class="px-4 py-3">
                        Rp <?php echo e(number_format($e->total, 0, ',', '.')); ?>

                    </td>

                    <td class="px-4 py-3">
                        <?php if($e->status == 'draft'): ?>
                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-lg">
                                Draft
                            </span>
                        <?php else: ?>
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-lg">
                                Approved
                            </span>
                        <?php endif; ?>
                    </td>

                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-2">

                            <a href="<?php echo e(route('estimations.show', $e->id)); ?>"
                                class="px-3 py-1 text-xs bg-blue-500 text-white rounded-lg">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="<?php echo e(route('invoices.from-estimation', $e->id)); ?>"
                                class="px-3 py-1 text-xs bg-green-500 text-white rounded-lg">
                                <i class="bi bi-receipt"></i>
                            </a>

                            <form action="<?php echo e(route('estimations.destroy', $e->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button onclick="return confirm('Yakin hapus?')"
                                    class="px-3 py-1 text-xs bg-red-500 text-white rounded-lg">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-400">
                        Belum ada estimasi
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/estimations/index.blade.php ENDPATH**/ ?>