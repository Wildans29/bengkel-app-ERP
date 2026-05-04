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
            <img src="{{ public_path('logo.png') }}" class="logo">
        </div>

        <div class="title">
            <h2>TAGIHAN</h2>
            <p>{{ $bill->bill_no }}</p>
        </div>
    </div>

    <!-- INFO -->
    <table style="margin-top:20px;">
        <tr>
            <td>
                <strong>Customer:</strong><br>
                {{ $bill->customer->name ?? '-' }}
            </td>

            <td class="right">
                <strong>Tanggal:</strong><br>
                {{ \Carbon\Carbon::parse($bill->date)->format('d M Y') }}
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
            @foreach($bill->invoices as $i => $inv)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $inv->invoice_no }}</td>
                <td class="right">
                    Rp {{ number_format($inv->total,0,',','.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTAL -->
    <table class="total">
        <tr>
            <td><strong>Total Tagihan</strong></td>
            <td class="right">
                <strong>Rp {{ number_format($bill->total,0,',','.') }}</strong>
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
</html>