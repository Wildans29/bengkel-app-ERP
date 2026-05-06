<?php $__env->startSection('title', 'Customer'); ?>

<?php $__env->startSection('content'); ?>

<!-- Header -->
<div class="flex justify-end items-center mb-6">

    <a href="<?php echo e(route('customers.create')); ?>" class="btn-primary flex gap-2 items-center">
        <i class="bi bi-plus"></i> Tambah
    </a>

</div>

<!-- Filter -->
<div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">

    <!-- Search -->
    <form method="GET" class="flex gap-2 w-full md:w-auto">

        <input type="text" name="search"
            value="<?php echo e(request('search')); ?>"
            placeholder="Cari customer..."
            class="input-field w-full md:w-72">

        <button class="btn-primary px-3">
            <i class="bi bi-search"></i>
        </button>

    </form>

    <!-- Per Page -->
    <form method="GET" class="flex items-center gap-2">

        <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">

        <label class="text-sm">Tampilkan</label>

        <select name="per_page"
            onchange="this.form.submit()"
            class="input-field">

            <option value="10" <?php echo e(request('per_page') == 10 ? 'selected' : ''); ?>>10</option>
            <option value="25" <?php echo e(request('per_page') == 25 ? 'selected' : ''); ?>>25</option>
            <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50</option>
            <option value="all" <?php echo e(request('per_page') == 'all' ? 'selected' : ''); ?>>Semua</option>

        </select>

        <span class="text-sm">data</span>

    </form>

</div>

<!-- Table -->
<div id="table-data">
    <?php echo $__env->make('customers.partials.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<!-- Pagination -->
<?php if(method_exists($customers, 'links')): ?>
<div class="mt-4">
    <?php echo e($customers->links()); ?>

</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/customers/index.blade.php ENDPATH**/ ?>