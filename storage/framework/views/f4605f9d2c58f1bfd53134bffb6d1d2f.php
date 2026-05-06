<?php $__env->startSection('title', 'Tambah Customer'); ?>

<?php $__env->startSection('content'); ?>

<!-- Form -->
<div class="card max-w-2xl">

    <form action="<?php echo e(route('customers.store')); ?>" method="POST" class="space-y-5">
        <?php echo csrf_field(); ?>

        <!-- Nama -->
        <div>
            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="name"
                value="<?php echo e(old('name')); ?>"
                class="input-field w-full"
                placeholder="Masukkan nama">

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

        <!-- Email -->
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email"
                value="<?php echo e(old('email')); ?>"
                class="input-field w-full"
                placeholder="Masukkan email">

            <?php $__errorArgs = ['email'];
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

        <!-- Telepon -->
        <div>
            <label class="block text-sm mb-1">Telepon</label>
            <input type="text" name="phone"
                value="<?php echo e(old('phone')); ?>"
                class="input-field w-full"
                placeholder="Masukkan nomor">

            <?php $__errorArgs = ['phone'];
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

        <!-- Alamat -->
        <div>
            <label class="block text-sm mb-1">Alamat</label>
            <textarea name="address"
                rows="3"
                class="input-field w-full"
                placeholder="Masukkan alamat"><?php echo e(old('address')); ?></textarea>

            <?php $__errorArgs = ['address'];
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
            <a href="<?php echo e(route('customers.index')); ?>"
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
                    Simpan
                </button>

            </div>

        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/customers/create.blade.php ENDPATH**/ ?>