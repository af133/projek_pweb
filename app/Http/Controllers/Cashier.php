<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Support\Carbon;
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
        $data = $request->input('orders');
        $orders = json_decode($data, true);

        $order_id = Order::create([
            'user_id' => auth()->id(),
            'order_date' => now()
        ])->id;

        foreach ($orders as $order) {
            $item = Item::find($order['id']);

            if ($item && $item->stok >= $order['count']) {
                $item->stok -= $order['count'];
                $item->save();

                DetailOrder::create([
                    'order_id' => $order_id,
                    'item_id' => $item->id,
                    'purchase_quantity' => $order['count']
                ]);
            } else {
                return redirect()->route('cashier')->with('error', 'Failed to place the order');
            }
        }
        return redirect()->route('cashier')->with('success', 'Order successfully created');

    }

    public function orderHistory()
    {
       $orders = DetailOrder::with(['order.user', 'item'])->whereHas('order',function ($query) { $query->where('user_id', auth()->id())->whereDate('order_date', Carbon::today());})->get();
        
        return view('cashier.order', compact('orders'));
    }
}
