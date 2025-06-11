@props(['datum'])
@php
    $pathGambar = $datum['path_item'];
@endphp

<div class="bg-[#EAEFC4] dark:bg-gray-800 w-full max-w-[11rem] rounded-xl shadow-md overflow-hidden m-2 border border-gray-200 dark:border-gray-700 transition">
    <div class="w-full p-3 h-28 overflow-hidden">
        <img src="{{ asset($pathGambar) }}" alt="{{ $datum['namaBarang'] }}" class="rounded-2xl object-cover w-full h-full">
    </div>
    <div class="p-2 flex flex-col justify-between">
        <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-1">
            <h1 class="font-semibold text-[1rem] text-gray-800 dark:text-white text-center mb-1 leading-tight">
                {{ $datum['item_name'] }}
            </h1>
            <p class="text-[0.75rem]"><strong>x</strong> {{ $datum['price'] }}</p>
        </div>
        <div class="flex justify-between text-[0.65rem] text-gray-700 dark:text-gray-300 mb-1">
            <p><strong>Stok:</strong> {{ $datum['stok'] }}</p>
            <button onclick='orderNow(@json($datum["id"]), @json($datum["item_name"]), @json($pathGambar), @json($datum["price"]))' class="text-[0.7rem] px-2 py-1 font-semibold rounded-md bg-[#225E00] text-white border-2 cursor-pointer border-[#225E00] hover:bg-white hover:text-[#225E00] dark:hover:bg-gray-700 transition">
                Tambah
            </button>
        </div>
    </div>
</div>
