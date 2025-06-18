<x-layouts.app :title="__('Stock Management')">
@php
    $isEdit = isset($item);
@endphp

<!-- Select2 & jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6 text-green-800 dark:text-green-300">
        {{ $isEdit ? 'Edit Produk' : 'Tambah Produk' }}
    </h2>

    <form action="{{ $isEdit ? route('stock_management.update', $item->id) : route('stock_management.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Nama Produk -->
        <div>
            <label class="block text-sm font-medium text-green-800 dark:text-green-300 mb-2">Nama Produk</label>
            <input type="text" name="item_name" value="{{ old('item_name', $item->item_name ?? '') }}" required
                   class="w-full px-4 py-2 border border-green-300 dark:border-green-700 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <!-- Stok -->
        <div>
            <label class="block text-sm font-medium text-green-800 dark:text-green-300 mb-2">Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $item->stok ?? '') }}" min="0" required
                   class="w-full px-4 py-2 border border-green-300 dark:border-green-700 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <!-- Harga -->
        <div>
            <label class="block text-sm font-medium text-green-800 dark:text-green-300 mb-2">Harga</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-green-600 font-semibold">Rp</span>
                <input type="number" name="price" step="0.01" value="{{ old('price', $item->price ?? '') }}" required
                       class="w-full pl-10 px-4 py-2 border border-green-300 dark:border-green-700 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
        </div>

        <!-- Gambar -->
        <div>
            <label class="block text-sm font-medium text-green-800 dark:text-green-300 mb-2">Gambar Produk</label>
            <input type="file" name="path_item" id="path_item" accept="image/*"
                   class="block w-full text-sm text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700 transition" 
                   onchange="previewImage(event)">
            <div class="mt-3">
                <img id="preview"
                     src="{{ isset($item->path_item) ? asset('storage/' . $item->path_item) : '' }}"
                     alt="Preview"
                     class="w-32 h-32 object-cover rounded-md border border-green-200 {{ isset($item->path_item) ? '' : 'hidden' }}">
            </div>
        </div>

        <!-- Kategori -->
        <div>
            <label class="block text-sm font-medium text-green-800 dark:text-green-300 mb-2">Kategori</label>

            <select name="category_item_id" id="categorySelect"
                    class="select2 w-full px-4 py-2 border border-green-300 dark:border-green-700 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                <option></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_item_id', $item->category_item_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_item_name }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="new_category" id="newCategoryInput" placeholder="Tambah Kategori Baru"
                   class="mt-2 w-full px-4 py-2 border border-green-300 dark:border-green-700 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                   style="display: none;" disabled>

            <button type="button" id="toggleCategoryInput"
                    class="mt-2 text-sm text-green-600 hover:underline">
                Tambah Kategori Baru
            </button>
        </div>

        <!-- Tombol -->
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('stock_management') }}"
               class="px-5 py-2 border border-green-500 text-green-700 rounded hover:bg-green-50 dark:hover:bg-green-900 transition">
                Batal
            </a>
            <button type="submit"
                    class="bg-green-700 hover:bg-green-600 text-white px-6 py-2 rounded-md transition font-semibold">
                {{ $isEdit ? 'Update Produk' : 'Tambah Produk' }}
            </button>
        </div>
    </form>
</div>

<!-- JS -->
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Pilih kategori...',
            allowClear: true
        });

        $('#toggleCategoryInput').click(function () {
            const $select = $('#categorySelect');
            const $input = $('#newCategoryInput');
            const $button = $(this);

            if ($select.is(':visible')) {
                $select.hide().prop('disabled', true);
                $input.show().prop('disabled', false);
                $button.text('Kembali ke Daftar Kategori');
            } else {
                $select.show().prop('disabled', false);
                $input.hide().prop('disabled', true).val('');
                $button.text('Tambah Kategori Baru');
            }
        });
    });
</script>
</x-layouts.app>
