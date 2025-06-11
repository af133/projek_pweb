<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StockManagementController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $item = new Item();
        $item->item_name = $validated['item_name'];
        $item->stok = $validated['stok'];
        $item->price = $validated['price'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $item->image = $imagePath;
        }

        $item->save();

        return redirect()->route('stock_management')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $item = Item::findOrFail($id);
        $item->item_name = $validated['item_name'];
        $item->stok = $validated['stok'];
        $item->price = $validated['price'];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $item->image = $imagePath;
        }

        $item->save();

        return redirect()->route('stock_management')->with('success', 'Produk berhasil diperbarui');
    }
}
