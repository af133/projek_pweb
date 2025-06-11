<!-- Form -->
<form action="{{ isset($item) ? route('stock_management.update', $item->id) : route('stock_management.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @if(isset($item))
        @method('PUT')
    @endif

    <!-- Image Upload -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Gambar Produk
        </label>
        <div class="flex items-center gap-4">
            @if(isset($item) && $item->image)
                <img src="{{ asset('storage/' . $item->image) }}"
                     alt="{{ $item->item_name }}"
                     class="w-24 h-24 object-cover rounded-lg border border-green-100">
            @endif
            <div class="flex-1">
                <input type="file"
                       name="image"
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <p class="mt-1 text-sm text-gray-500">
                    PNG, JPG, GIF up to 2MB
                </p>
            </div>
        </div>
    </div>

    <!-- Product Name -->
    <div>
        <label for="item_name" class="block text-sm font-medium text-gray-700 mb-2">
            Nama Produk
        </label>
        <input type="text"
               name="item_name"
               id="item_name"
               value="{{ isset($item) ? $item->item_name : old('item_name') }}"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
               required>
    </div>

    <!-- Stock -->
    <div>
        <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
            Stok
        </label>
        <input type="number"
               name="stok"
               id="stok"
               value="{{ isset($item) ? $item->stok : old('stok') }}"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
               required>
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
            Harga
        </label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                Rp
            </span>
            <input type="number"
                   name="price"
                   id="price"
                   value="{{ isset($item) ? $item->price : old('price') }}"
                   class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   required>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end gap-4">
        <a href="{{ route('stock_management') }}"
           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
            Batal
        </a>
        <button type="submit"
                class="px-4 py-2 bg-green-800 text-white rounded-md hover:bg-green-700 transition-colors">
            {{ isset($item) ? 'Update Produk' : 'Tambah Produk' }}
        </button>
    </div>
</form>