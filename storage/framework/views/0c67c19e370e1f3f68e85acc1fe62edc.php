<?php $__env->startSection('title', 'Edit Barang'); ?>

<?php $__env->startSection('content'); ?>

<!-- Form -->
<div class="card max-w-2xl">

    <form method="POST" action="<?php echo e(route('items.update', $item->id)); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Nama -->
        <div>
            <label class="block text-sm mb-1">Nama Barang</label>
            <input type="text" name="name"
                value="<?php echo e(old('name', $item->name)); ?>"
                class="input-field w-full"
                placeholder="Masukkan nama barang"
                required>

            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Stok -->
        <div>
            <label class="block text-sm mb-1">Stok</label>
            <input type="number" name="stock"
                value="<?php echo e(old('stock', $item->stock)); ?>"
                class="input-field w-full"
                min="0"
                required>

            <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Harga Beli -->
        <div>
            <label class="block text-sm mb-1">Harga Beli</label>
            <input type="number" name="buy_price"
                value="<?php echo e(old('buy_price', $item->buy_price)); ?>"
                class="input-field w-full"
                min="0"
                required>

            <?php $__errorArgs = ['buy_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Harga Jual -->
        <div>
            <label class="block text-sm mb-1">Harga Jual</label>
            <input type="number" name="sell_price"
                value="<?php echo e(old('sell_price', $item->sell_price)); ?>"
                class="input-field w-full"
                min="0"
                required>

            <?php $__errorArgs = ['sell_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Action -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">

            <!-- Back -->
            <a href="<?php echo e(route('items.index')); ?>"
               class="text-gray-500 hover:underline text-sm">
                ← Kembali
            </a>

            <!-- Buttons -->
            <div class="flex gap-2">

                <button type="reset"
                    class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 rounded-lg">
                    Reset
                </button>

                <button type="submit"
                    class="btn-primary flex items-center gap-2">
                    <i class="bi bi-save"></i>
                    Update
                </button>

            </div>

        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/items/edit.blade.php ENDPATH**/ ?>