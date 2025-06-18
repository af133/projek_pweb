<x-layouts.app :title="__('Order History')">
<div class="min-h-screen flex flex-col items-center py-8">
    <!-- Judul dan Subjudul -->
    <div class="w-full max-w-5xl flex flex-col gap-1 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Histori Transaksi</h1>
        <p class="text-gray-500">Daftar penjualan toko hari ini</p>
    </div>
    <!-- Tabel -->
    <div class="w-full max-w-5xl bg-white rounded-lg overflow-hidden">
        <table class="w-full table-auto text-base">
            <thead>
                <tr class="bg-green-700 text-white">
                    <th class="py-4 px-6 text-left w-[40%]">Product</th>
                    <th class="py-4 px-6 text-center w-[20%]">Date</th>
                    <th class="py-4 px-6 text-center w-[20%]">Price</th>
                    <th class="py-4 px-6 text-center w-[20%]">Quantity</th>
                </tr>
            </thead>
            <tbody class="bg-[#f3ffe4]">
                @foreach ($orders as $order)
                    <tr class="border-b border-gray-200 last:border-0">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/' . $order['item']['path_item']) }}" alt="{{ $order['item']['item_name'] }}"
                                class="w-full max-w-[80px] h-auto object-contain bg-white rounded border border-gray-200">

                                <span class="font-medium text-gray-900">{{ $order['item']['item_name'] }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">{{ \Carbon\Carbon::parse($order['order']['order_date'])->format('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6 text-center">Rp. {{ number_format($order['purchase_quantity'] * $order['item']['price'], 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-center">{{ $order['purchase_quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
                {{ $orders->links() }}
        </div>

    </div>
</div>
</x-layouts.app>
