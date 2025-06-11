<x-layouts.app :title="__('Order History')">
<p class="text-[#34364A] font-bold text-3xl">Histori Transaksi</p>
<p class="text-[#34364A] my-4">Daftar penjualan toko hari ini</p>
<div class="overflow-x-auto">
    <table class="w-full table-auto text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
            <tr>
                <th class="px-4 py-2">Item Name</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Qty</th>
                <th class="px-4 py-2">Total Price</th>
                <th class="px-4 py-2">Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $orders as $order)
                <tr class="bg-[#EAEFC4] border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-4 py-2">{{ $order['item']['item_name'] }}</td>
                    <td class="px-4 py-2">
                        <img src="{{ asset('storage/' . $order['item']['path_item']) }}" alt="" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="px-4 py-2">{{ $order['purchase_quantity'] }}</td>
                    <td class="px-4 py-2">
                        Rp {{ number_format($order['purchase_quantity'] * $order['item']['price'], 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($order['order']['order_date'])->format('d M Y H:i') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-layouts.app >