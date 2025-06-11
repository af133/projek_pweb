<div>
    <!-- Search and Action Section -->
    <div class="flex gap-4 items-center">
        <!-- Search Bar -->
        <div class="flex-1 relative">
            <input type="text"
                   wire:model.live="search"
                   placeholder="Cari Barang"
                   class="w-full px-4 py-2 bg-white border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800 placeholder-gray-700">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <!-- Action Button -->
        <a href="{{ route('editOrcreate') }}" class="px-4 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition-colors whitespace-nowrap">
            Tambah Produk
        </a>
    </div>

    <!-- Products List -->
    <div class="mt-6 bg-green-50 rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="grid grid-cols-12 gap-4 py-4 px-6 bg-green-800 text-white rounded-t-lg">
            <div class="col-span-4 text-left">Product</div>
            <div class="col-span-3 text-center">Stock</div>
            <div class="col-span-3 text-center">Price</div>
            <div class="col-span-2 text-right">Action</div>
        </div>

        <!-- Items -->
        <div class="divide-y divide-green-100">
            @foreach ($items as $item)
                <div class="grid grid-cols-12 gap-4 py-4 px-6 items-center hover:bg-green-50">
                    <div class="col-span-4 text-left text-gray-800 font-medium flex items-center gap-3">
                        @if($item->path_item)
                            <img src="{{ asset('storage/' . $item->path_item) }}"
                                 alt="{{ $item->item_name }}"
                                 class="w-12 h-12 object-cover rounded-lg border border-green-100"
                                 onerror="this.src='{{ asset('images/default-product.png') }}'; this.onerror=null;">
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg border border-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <span class="truncate">{{ $item->item_name }}</span>
                    </div>
                    <div class="col-span-3 text-center text-gray-700">{{ $item->stok }}</div>
                    <div class="col-span-3 text-center text-gray-800">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                    <div class="col-span-2 text-right">
                        <a href="{{ route('editOrcreate', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-green-100 rounded-full hover:bg-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
