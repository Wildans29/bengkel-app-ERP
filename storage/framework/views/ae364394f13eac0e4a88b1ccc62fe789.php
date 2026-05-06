<div class="card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm">

            <!-- Head -->
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Stok</th>
                    <th class="px-4 py-3 text-left">Harga Beli</th>
                    <th class="px-4 py-3 text-left">Harga Jual</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5">

                    <!-- Nomor -->
                    <td class="px-4 py-3">
                        <?php if(method_exists($items, 'firstItem')): ?>
                            <?php echo e($items->firstItem() + $index); ?>

                        <?php else: ?>
                            <?php echo e($index + 1); ?>

                        <?php endif; ?>
                    </td>

                    <td class="px-4 py-3 font-medium"><?php echo e($item->name); ?></td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded bg-gray-200 dark:bg-gray-700">
                            <?php echo e($item->stock); ?>

                        </span>
                    </td>

                    <td class="px-4 py-3">Rp <?php echo e(number_format($item->buy_price)); ?></td>
                    <td class="px-4 py-3">Rp <?php echo e(number_format($item->sell_price)); ?></td>

                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-2">

                            <a href="<?php echo e(route('items.edit', $item->id)); ?>"
                                class="px-3 py-1 text-xs bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="<?php echo e(route('items.destroy', $item->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button onclick="return confirm('Yakin hapus?')"
                                    class="px-3 py-1 text-xs bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        Tidak ada data barang
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>
<?php /**PATH C:\laragon\www\inventory-app\resources\views/items/partials/table.blade.php ENDPATH**/ ?>