<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page ?? 10;

        $query = Item::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })->latest();

        // Jika pilih "semua"
        if ($perPage === 'all') {
            $items = $query->get();
        } else {
            $items = $query->paginate($perPage)->withQueryString();
        }

        // AJAX (live search)
        if ($request->ajax()) {
            return view('items.partials.table', compact('items'))->render();
        }

        return view('items.index', compact('items'));
    }


    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
        ]);

        Item::create($validate);

        return redirect()->route('items.index')->with('success', 'Sparepart berhasil ditambahkan!');
    }

    /**
        * Show the form for editing the specified resource.
    */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validate = $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
        ]);

        $item->update($validate);

        return redirect()->route('items.index')->with('success', 'Sparepart berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Sparepart berhasil dihapus!');
    }
}
