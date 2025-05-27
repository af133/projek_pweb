@props(['datum'])
@php
    $pathGambar = $datum['path_item'];
@endphp

<div class="bg-white dark:bg-gray-800 w-full max-w-[11rem] rounded-xl shadow-md overflow-hidden m-2 border border-gray-200 dark:border-gray-700 transition">

    <!-- Gambar -->

    <div class="w-full h-28 overflow-hidden">
        <img src="{{ asset($pathGambar) }}" alt="{{ $datum['namaBarang'] }}" class="object-cover w-full h-full">
    </div>

    <!-- Info -->

    <div class="p-2 flex flex-col justify-between">
        <h1 class="font-semibold text-[0.75rem] text-gray-800 dark:text-white text-center mb-1 leading-tight">
            {{ $datum['item_name'] }}
        </h1>

        <div class="flex justify-between text-[0.65rem] text-gray-700 dark:text-gray-300 mb-1">
            <p><strong>$:</strong> {{ $datum['price'] }}</p>
            <p><strong>Stok:</strong> {{ $datum['stok'] }}</p>
        </div>

        <button onclick="orderNow('{{ $datum['item_name']  }}', '{{ $pathGambar }}', {{ $datum['price'] }}, {{ $datum['hargaBarang'] }})"
            class="w-full text-[0.7rem] px-2 py-1 font-semibold rounded-md bg-[#D1293F] text-white border-2 border-[#D1293F] hover:bg-white hover:text-[#D1293F] dark:hover:bg-gray-700 transition">
            Order
        </button>
    </div>
</div>
