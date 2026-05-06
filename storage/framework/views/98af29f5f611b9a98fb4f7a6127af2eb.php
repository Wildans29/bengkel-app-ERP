<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size:12px; color:#111; }
        .container { padding:20px; }

        .header {
            display:flex; justify-content:space-between; align-items:center;
        }

        .logo { height:60px; }
        .title { text-align:right; }

        table {
            width:100%; border-collapse:collapse; margin-top:15px;
        }

        th, td {
            border:1px solid #ddd; padding:8px;
        }

        th { background:#f5f5f5; }
        .right { text-align:right; }

        .total {
            margin-top:10px;
            width:300px;
            float:right;
        }

        .footer {
            margin-top:80px;
            text-align:right;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <img src="<?php echo e(public_path('logo.png')); ?>" class="logo">
        </div>

        <div class="title">
            <h2>ESTIMASI</h2>
            
        </div>
    </div>

    <!-- INFO -->
    <table style="margin-top:20px;">
        <tr>
            <td>
                <strong>Customer:</strong><br>
                <?php echo e($estimation->customer->name ?? '-'); ?>

            </td>

            <td class="right">
                <strong>Tanggal:</strong><br>
                <?php echo e(\Carbon\Carbon::parse($estimation->date)->format('d M Y')); ?>

            </td>
        </tr>
    </table>

    <!-- ITEMS -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $estimation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i+1); ?></td>
                <td><?php echo e($row->item->name ?? '-'); ?></td>
                <td><?php echo e($row->qty); ?></td>
                <td>Rp <?php echo e(number_format($row->price,0,',','.')); ?></td>
                <td class="right">
                    Rp <?php echo e(number_format($row->subtotal,0,',','.')); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- TOTAL -->
    <table class="total">
        <tr>
            <td><strong>Total Estimasi</strong></td>
            <td class="right">
                <strong>Rp <?php echo e(number_format($estimation->total,0,',','.')); ?></strong>
            </td>
        </tr>
    </table>

    <div style="clear:both;"></div>

    <!-- FOOTER -->
    <div class="footer">
        <p>Hormat kami,</p>
        <br><br>
        <strong>Bengkel Anda</strong>
    </div>

</div>

</body>
</html><?php /**PATH C:\laragon\www\inventory-app\resources\views/estimations/pdf.blade.php ENDPATH**/ ?>