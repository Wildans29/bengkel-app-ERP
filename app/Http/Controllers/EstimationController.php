<?php

namespace App\Http\Controllers;

use App\Models\Estimation;
use App\Models\Customer;
use App\Models\EstimationItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EstimationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estimations = Estimation::with('customer')->latest()->get();
        return view('estimations.index', compact('estimations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();

        return view('estimations.create', compact('customers', 'items' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->items);
        $estimation = Estimation::create([
            'customer_id' => $request->customer_id,
            'date' => now(),
            'total' => 0,
            'status' => 'draft'
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            $subtotal = $item['qty'] * $item['price'];

            EstimationItem::create([
                'estimation_id' => $estimation->id,
                'type' => 'item',
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $subtotal
            ]);

            $total += $subtotal;
        }

        $estimation->update(['total' => $total]);

        return redirect()->route('estimations.index')->with('success', 'Estimasi berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimation $estimation)
    {
        $estimation->load('items.item', 'customer');
        $items = Item::all();

        return view('estimations.show', compact('estimation', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function print($id)
    {
        $estimation = \App\Models\Estimation::with('customer', 'items.item')
            ->findOrFail($id);

        $pdf = Pdf::loadView('estimations.pdf', compact('estimation'))
            ->setPaper('A4');

        return $pdf->download('estimasi-'.$estimation->id.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimation $estimation)
    {
        $estimation->items()->delete();

        $total = 0;

        foreach ($request->items as $item) {

            $dbItem = Item::find($item['id']);
            $price = $dbItem->sell_price;

            $subtotal = $item['qty'] * $price;

            EstimationItem::create([
                'estimation_id' => $estimation->id,
                'type' => 'item',
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'price' => $price,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $estimation->update(['total' => $total]);

        return redirect()->route('estimations.index')
            ->with('success', 'Estimasi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimation $estimation)
    {
        $estimation->items()->delete();

        // hapus estimasi
        $estimation->delete();

        return redirect()->route('estimations.index')
            ->with('success', 'Estimasi berhasil dihapus!');
    }
}
