<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Attributes\CollectedBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class BillController extends Controller
{
    private function generateBillNo()
    {
        $date = now()->format('Ymd');

        $last = Bill::whereDate('created_at', now())
            ->latest()
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->bill_no, -4);
            $number = $lastNumber + 1;
        } else {
            $number = 1;
        }

        return 'BILL-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('customer')->latest()->get();

        return view('bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customers = Customer::all();

        $invoices = collect();

        if ($request->customer_id) {
            $invoices = Invoice::where('customer_id', $request->customer_id)
                ->where('status', 'unpaid')
                ->get();
        }

        return view('bills.create', compact('customers','invoices'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'customer_id' => 'required',
        'invoice_ids' => 'required|array|min:1'
        ]);

        $invoices = Invoice::whereIn('id', $request->invoice_ids)->get();

        // 🔥 VALIDASI: semua invoice harus customer yang sama
        $customerId = $invoices->first()->customer_id;

        foreach ($invoices as $inv) {
            if ($inv->customer_id != $customerId) {
                return back()->with('error', 'Invoice harus dari customer yang sama!');
            }
        }

        // 🔥 BUAT BILL
        $bill = Bill::create([
            'customer_id' => $customerId,
            'bill_no' => $this->generateBillNo(), // 🔥 WAJIB ADA
            'date' => now(),
            'total' => 0,
            'status' => 'unpaid'
        ]);

        $total = 0;

        foreach ($invoices as $inv) {
            $bill->invoices()->attach($inv->id);
            $total += $inv->total;
        }

        $bill->update(['total' => $total]);

        return redirect()->route('bills.index')
            ->with('success', 'Tagihan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        $bill->load('invoices.customer');

        return view('bills.show', compact('bill'));
    }

    public function print($id)
    {
        $bill = \App\Models\Bill::with('customer', 'invoices')
            ->findOrFail($id);

        $pdf = Pdf::loadView('bills.pdf', compact('bill'))
            ->setPaper('A4');

        return $pdf->download('tagihan-'.$bill->bill_no.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        DB::beginTransaction();

        try {

            if ($bill->status == 'paid') {
                return back()->with('error', 'Tagihan sudah dibayar tidak bisa dihapus!');
            }

            foreach ($bill->invoices as $inv) {
                $inv->update(['status' => 'unpaid']);
            }

            $bill->invoices()->detach();

            $bill->delete();

            DB::commit();

            return redirect()->route('bills.index')
                ->with('success', 'Tagihan berhasil dihapus!');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal menghapus tagihan!');
        }
    }
}
