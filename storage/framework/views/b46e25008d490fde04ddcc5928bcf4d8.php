<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

    <!-- Customer -->
    <div class="card flex items-center justify-between">
        <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Total Customer</p>
            <h2 class="text-2xl font-bold"><?php echo e($totalCustomer); ?></h2>
        </div>
        <div class="bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 p-3 rounded-xl text-xl">
            <i class="bi bi-people"></i>
        </div>
    </div>

    <!-- Transaksi -->
    <div class="card flex items-center justify-between">
        <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Total Transaksi</p>
            <h2 class="text-2xl font-bold"><?php echo e($totalInvoice); ?></h2>
        </div>
        <div class="bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 p-3 rounded-xl text-xl">
            <i class="bi bi-receipt"></i>
        </div>
    </div>

    <!-- Pendapatan -->
    <div class="card flex items-center justify-between">
        <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Pendapatan Hari Ini</p>
            <h2 class="text-2xl font-bold">
                Rp <?php echo e(number_format($todayRevenue)); ?>

            </h2>
        </div>
        <div class="bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400 p-3 rounded-xl text-xl">
            <i class="bi bi-cash-stack"></i>
        </div>
    </div>

</div>

<!-- Chart -->
<div class="mt-8 card">

    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Penjualan 30 Hari</h3>
        <span class="text-sm text-gray-400">Last 30 days</span>
    </div>

    <?php if($data->isEmpty()): ?>
        <p class="text-gray-400 text-center py-10">
            Belum ada data penjualan
        </p>
    <?php else: ?>
        <canvas id="salesChart"></canvas>
    <?php endif; ?>

</div>

<!-- Chart Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('salesChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels, 15, 512) ?>,
            datasets: [{
                label: 'Penjualan',
                data: <?php echo json_encode($data, 15, 512) ?>,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.08)',
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#9ca3af'
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#9ca3af' }
                },
                y: {
                    ticks: { color: '#9ca3af' }
                }
            }
        }
    });

});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory-app\resources\views/dashboard.blade.php ENDPATH**/ ?>