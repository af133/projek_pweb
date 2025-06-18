<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class Cashier extends Controller
{

   public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $query = Item::with('category')
            ->where('user_id', auth()->id())
            ->where('stok', '>', 0);

        if ($search) {
            $query->where('item_name', 'like', '%' . $search . '%');
        }

        if ($category && $category !== 'all') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category_item_name', $category);
            });
        }

        $items = $query->get()->groupBy(function ($item) {
            return optional($item->category)->category_item_name ?? 'Tanpa Kategori';
        });

        return view('cashier.index', compact('items', 'search', 'category'));
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
    $orders = DetailOrder::with(['order.user', 'item'])
        ->whereHas('order', function ($query) {
            $query->where('user_id', auth()->id())
                  ->whereDate('order_date', Carbon::today());
        })
        ->paginate(20); 

    return view('cashier.order', compact('orders'));
}
    public function report(Request $request)
    {
        $year = $request->get('year', now()->year);
        $range = $request->get('range', 'week');

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $topItems = DetailOrder::with('item')
            ->whereHas('order', fn($q) => $q->whereBetween('order_date', [$startOfWeek, $endOfWeek]))
            ->selectRaw('item_id, SUM(purchase_quantity) as total')
            ->groupBy('item_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $pieLabels = $topItems->pluck('item.item_name');
        $pieCounts = $topItems->pluck('total');

        $incomeLabels = [];
        $incomeData = [];

        if ($range === 'week') {
            foreach (range(0, 6) as $i) {
                $date = now()->startOfWeek()->addDays($i);
                $label = $date->format('D');
                $total = Order::whereDate('order_date', $date)
                    ->with('detail_order.item')
                    ->get()
                    ->flatMap(fn($order) => $order->detail_order)
                    ->sum(fn($d) => $d->purchase_quantity * $d->item->price);

                $incomeLabels[] = $label;
                $incomeData[] = $total;
            }
        } elseif ($range === 'month') {
            foreach (range(1, 12) as $m) {
                $label = Carbon::create()->month($m)->format('M');
                $total = Order::whereYear('order_date', $year)
                    ->whereMonth('order_date', $m)
                    ->with('detail_order.item')
                    ->get()
                    ->flatMap(fn($order) => $order->detail_order)
                    ->sum(fn($d) => $d->purchase_quantity * $d->item->price);

                $incomeLabels[] = $label;
                $incomeData[] = $total;
            }
        } elseif ($range === 'year') {
            foreach (range($year - 5, $year) as $y) {
                $label = (string) $y;
                $total = Order::whereYear('order_date', $y)
                    ->with('detail_order.item')
                    ->get()
                    ->flatMap(fn($order) => $order->detail_order)
                    ->sum(fn($d) => $d->purchase_quantity * $d->item->price);

                $incomeLabels[] = $label;
                $incomeData[] = $total;
            }
        }

        return view('cashier.report', compact('pieLabels', 'pieCounts', 'incomeLabels', 'incomeData'));
    }
}
