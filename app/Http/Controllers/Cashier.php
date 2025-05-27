<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class Cashier extends Controller
{

    public function index()
    {
        $items = Item::with('category')->where('user_id', auth()->id())->where('stok', '>', 0)->get()->groupBy(function($item) 
        {
            return optional($item->category)->category_item_name ?? 'Tanpa Kategori'; 
        });

        return view('cashier.index',['items'=>$items]);
    }

    public function order(Request $request){
        $request->validate([

            'item_id' => 'required|array',
            'item_id.*' => 'exists:items,id',
            'purchase_quantity' => 'required|array',
            'purchase_quantity.*' => 'integer|min:1',

        ]);

        $order = auth()->user()->orders()->create(['order_date' => now()]);

        foreach ($request->item_id as $index => $itemId) {
            $order->detail_order()->create([
                'item_id' => $itemId,
                'purchase_quantity' => $request->purchase_quantity[$index],
            ]);
        }

        return redirect()->route('cashier')->with('success', 'Order placed successfully.');
    }

}
