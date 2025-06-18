<x-layouts.app :title="__('Cashier Dashboard')">
    {{-- Form Search & Filter --}}
    <form method="GET" action="{{ route('cashier') }}" class="mb-8 flex flex-wrap items-center gap-4">
        {{-- Search Input --}}
        <input type="text" name="search" value="{{ $search ?? '' }}"
            placeholder="Cari produk..."
            class="px-4 py-2 border-2 border-[#225E00] rounded-lg focus:ring-2 focus:ring-[#225E00] focus:outline-none w-full max-w-sm text-gray-900" />

        {{-- Category Dropdown --}}
        <select id="category" name="category"
            class="p-3 border-2 border-[#225E00] rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-[#225E00] focus:border-[#225E00] transition duration-200 shadow-sm font-semibold">
            <option value="all">-- Semua Kategori --</option>
            @foreach($items as $categoryName => $groupedItems)
                <option value="{{ $categoryName }}" {{ ($category ?? '') == $categoryName ? 'selected' : '' }}>
                    {{ $categoryName }}
                </option>
            @endforeach
        </select>

        {{-- Submit Button --}}
        <button type="submit"
            class="px-4 py-2 bg-[#225E00] text-white rounded-lg hover:bg-green-700 transition-colors">
            Cari
        </button>
    </form>

    {{-- Alert Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Jika Tidak Ada Produk --}}
    @if($items->isEmpty())
        <div class=" text-red-500 my-8 text-2xl">Produk tidak ditemukan.</div>
    @endif

    {{-- Produk Per Kategori --}}
    @foreach($items as $categoryName => $groupedItems)
        <div class="category-group" data-category="{{ $categoryName }}">
            <h2 class="text-xl font-bold text-[#225E00] ml-4 my-4">{{ $categoryName }}</h2>
            <div class="flex flex-wrap gap-4 px-4">
                @foreach($groupedItems as $item)
                    <x-card-product :datum="$item" />
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Form Order --}}
    <x-form-order/>
</x-layouts.app>
