<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Item;
use App\Models\DetailOrder;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
   public function index()
    {
        $userId = auth()->id();
        $today = Carbon::today();

        // Total Transaksi Hari Ini
        $totalTransaksiHariIni = DetailOrder::with(['order.user', 'item'])->whereHas('order',function ($query) { $query->where('user_id', auth()->id())->whereDate('order_date', Carbon::today());})->get()->count();

        // Total Pemasukan Hari Ini
        $totalPemasukanHariIni = Order::where('user_id', $userId)
            ->whereDate('order_date', Carbon::today())
            ->with('detail_order.item')
            ->get()
            ->flatMap(fn($order) => $order->detail_order)
            ->sum(fn($detail) => $detail->purchase_quantity * $detail->item->price);

        // Total Jumlah Barang (Stok)
        $totalJumlahBarang = Item::where('user_id', $userId)->sum('stok');

        // Barang Baru Hari Ini
        $barangBaruHariIni = Item::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->count();

        // Total Transaksi Keseluruhan
        $totalTransaksi = Order::where('user_id', $userId)->count();

        // Total Pendapatan Keseluruhan
        $totalPendapatan = Order::where('user_id', $userId)
            ->with('detail_order.item')
            ->get()
            ->flatMap(fn($order) => $order->detail_order)
            ->sum(fn($detail) => $detail->purchase_quantity * $detail->item->price);

        // Total Produk
        $totalProduk = Item::where('user_id', $userId)->count();

        // Aktivitas Terbaru (5 transaksi terakhir hari ini)
        $aktivitasTerbaru = DetailOrder::with(['order', 'item'])
            ->whereHas('order', function ($query) use ($userId, $today) {
                $query->where('user_id', $userId)
                      ->whereDate('order_date', $today);
            })
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($detail) {
                return "Transaksi: {$detail->item->item_name} x{$detail->purchase_quantity} - " . 
                       Carbon::parse($detail->order->order_date)->format('H:i');
            });

        // Jika tidak ada aktivitas hari ini, ambil aktivitas terbaru
        if ($aktivitasTerbaru->isEmpty()) {
            $aktivitasTerbaru = collect([
                'Belum ada transaksi hari ini',
                'Mulai berjualan untuk melihat aktivitas',
                'Dashboard akan menampilkan data real-time'
            ]);
        }

        // Barang dengan stok rendah (< 10)
        $barangStokRendah = Item::where('user_id', $userId)
            ->where('stok', '<=', 10)
            ->where('stok', '>=', 0)
            ->get()->count() ;

        $data = [
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
            'totalPemasukanHariIni' => 'Rp ' . number_format($totalPemasukanHariIni, 0, ',', '.'),
            'totalJumlahBarang' => number_format($totalJumlahBarang, 0, ',', '.'),
            'barangBaruHariIni' => $barangBaruHariIni,
            'totalTransaksi' => number_format($totalTransaksi, 0, ',', '.'),
            'totalPendapatan' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'),
            'totalProduk' => number_format($totalProduk, 0, ',', '.'),
            'aktivitasTerbaru' => $aktivitasTerbaru,
            'barangStokRendah' => $barangStokRendah
        ];

        return view('dashboard', $data);
    }

    public function getChartData(Request $request)
    {
        $userId = auth()->id();
        $range = $request->get('range', 'week');
        
        $data = [];
        
        if ($range === 'week') {
            // Data 7 hari terakhir
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $total = Order::where('user_id', $userId)
                    ->whereDate('order_date', $date)
                    ->with('detail_order.item')
                    ->get()
                    ->flatMap(fn($order) => $order->detail_order)
                    ->sum(fn($detail) => $detail->purchase_quantity * $detail->item->price);
                
                $data[] = [
                    'label' => $date->format('D'),
                    'value' => $total
                ];
            }
        } elseif ($range === 'month') {
            // Data 12 bulan terakhir
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $total = Order::where('user_id', $userId)
                    ->whereYear('order_date', $date->year)
                    ->whereMonth('order_date', $date->month)
                    ->with('detail_order.item')
                    ->get()
                    ->flatMap(fn($order) => $order->detail_order)
                    ->sum(fn($detail) => $detail->purchase_quantity * $detail->item->price);
                
                $data[] = [
                    'label' => $date->format('M'),
                    'value' => $total
                ];
            }
        }
        
        return response()->json($data);
    }
}
