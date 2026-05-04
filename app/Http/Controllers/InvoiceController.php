<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Estimation;
use App\Models\Item;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{

    private function generateNo()
    {
        $date = now()->format('Ymd');
        $last = Invoice::whereDate('created_at', now())->count() + 1;
        return 'INV-'.$date.'-'.str_pad($last, 4, '0', STR_PAD_LEFT);
    }

    public function createFromEstimation(Estimation $estimation)
    {
        $estimation->load('items.item', 'customer');
        $items = Item::all();

        return view('invoices.create', compact('estimation','items'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function print($id)
{
    $invoice = \App\Models\Invoice::with('customer','items')->findOrFail($id);

    // 🔥 DATA QR (misal: nomor invoice + total)
    $qrText = "INV: {$invoice->invoice_no}\nTOTAL: {$invoice->total}";

    // 🔥 simpan QR ke public/qrcodes
    $qrDir = public_path('qrcodes');
    if (!File::exists($qrDir)) {
        File::makeDirectory($qrDir, 0755, true);
    }

    $fileName = 'qr-' . Str::slug($invoice->invoice_no) . '.png';
    $filePath = $qrDir . '/' . $fileName;

    // pakai API gratis (cepat & simpel)
    if (!File::exists($filePath)) {
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrText);
        file_put_contents($filePath, file_get_contents($qrUrl));
    }

    $pdf = Pdf::loadView('invoices.pdf', [
        'invoice' => $invoice,
        'qr' => public_path('qrcodes/' . $fileName),
    ])->setPaper('A4');

    return $pdf->download('invoice-'.$invoice->invoice_no.'.pdf');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'customer_id'   => $request->customer_id,
            'estimation_id' => $request->estimation_id,
            'invoice_no'    => $this->generateNo(),
            'date'          => now(),
            'total'         => 0,
            'status'        => 'unpaid',
        ]);

        $total = 0;

        foreach ($request->items as $row) {

            $dbItem = Item::find($row['id']);

            if (!$dbItem || $row['qty'] <= 0) continue;

            $price = $dbItem->sell_price;

            $subtotal = $row['qty'] * $price;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'type'       => 'item',
                'item_id'    => $dbItem->id,
                'name'       => $dbItem->name,
                'qty'        => $row['qty'],
                'price'      => $price,
                'subtotal'   => $subtotal,
            ]);

            if ($dbItem->stock < $row['qty']) {
                return back()->with('error', 'Stock tidak cukup untuk ' . $dbItem->name);
            }

            // 🔥 INI YANG SEBELUMNYA KURANG
            $dbItem->decrement('stock', $row['qty']);

            $total += $subtotal;
        }

        $invoice->update(['total' => $total]);

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Invoice berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('items','customer');
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->items()->delete();
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success','Invoice dihapus');
    }
}
