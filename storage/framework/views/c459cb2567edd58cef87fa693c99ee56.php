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
            <h2>TAGIHAN</h2>
            <p><?php echo e($bill->bill_no); ?></p>
        </div>
    </div>

    <!-- INFO -->
    <table style="margin-top:20px;">
        <tr>
            <td>
                <strong>Customer:</strong><br>
                <?php echo e($bill->customer->name ?? '-'); ?>

            </td>

            <td class="right">
                <strong>Tanggal:</strong><br>
                <?php echo e(\Carbon\Carbon::parse($bill->date)->format('d M Y')); ?>

            </td>
        </tr>
    </table>

    <!-- LIST INVOICE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th class="right">Total</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $bill->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i+1); ?></td>
                <td><?php echo e($inv->invoice_no); ?></td>
                <td class="right">
                    Rp <?php echo e(number_format($inv->total,0,',','.')); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- TOTAL -->
    <table class="total">
        <tr>
            <td><strong>Total Tagihan</strong></td>
            <td class="right">
                <strong>Rp <?php echo e(number_format($bill->total,0,',','.')); ?></strong>
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
</html><?php /**PATH C:\laragon\www\inventory-app\resources\views/bills/pdf.blade.php ENDPATH**/ ?>