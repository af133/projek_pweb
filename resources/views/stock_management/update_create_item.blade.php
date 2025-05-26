<x-layouts.app :title="__('Stock Management')">
@php
    $isEdit = isset($item);
@endphp

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">
        {{ $isEdit ? 'Edit Item' : 'Create Item' }}
    </h2>

    <form action="{{ $isEdit ? route('stock_management.update', $item->id) : route('stock_management.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Item Name -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">Item Name</label>
            <input type="text" name="item_name" value="{{ old('item_name', $item->item_name ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Stock -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">Stock</label>
            <input type="number" name="stok" value="{{ old('stok', $item->stok ?? '') }}" required min="0"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">Price</label>
            <input type="number" name="price" value="{{ old('price', $item->price ?? '') }}" required step="0.01"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">Image</label>
            <input type="file" name="path_item" id="path_item" accept="image/*"
                class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700" onchange="previewImage(event)">
            <div class="mt-3">
                <img id="preview" src="{{ isset($item->path_item) ? asset('storage/' . $item->path_item) : '' }}" 
                     alt="Image Preview" class="w-32 h-32 object-cover rounded {{ isset($item->path_item) ? '' : 'hidden' }}">
            </div>
        </div>

<div class="mb-6">
    <label class="block text-gray-700 dark:text-gray-300 mb-2">Category</label>

    <!-- Category select dropdown -->
    <select 
        name="category_item_id" 
        id="categorySelect" 
        class="select2 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
    >
        <option></option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_item_id', $item->category_item_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->category_item_name }}
            </option>
        @endforeach
    </select>

    <!-- Hidden input for new category -->
    <input 
        type="text"
        name="new_category"
        id="newCategoryInput"
        placeholder="Add New Category"
        class="mt-2 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
        style="display: none;"
        disabled
    />

    <!-- Toggle button -->
    <button 
        type="button" 
        id="toggleCategoryInput"
        class="mt-2 text-sm text-blue-600 hover:underline"
    >
        Add New Category
    </button>
</div>




        <!-- Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('stock_management') }}"
                class="inline-block px-6 py-2 text-gray-700 dark:text-gray-300 border border-gray-400 dark:border-gray-600 rounded hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                Cancel
            </a>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded transition">
                {{ $isEdit ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
      $(document).ready(function () {
        $('#toggleCategoryInput').click(function () {
            const $select = $('#categorySelect');
            const $input = $('#newCategoryInput');
            const $button = $(this);

            if ($select.is(':visible')) {
                $select.hide().prop('disabled', true);   
                $input.show().prop('disabled', false);   
                $button.text('Back to Category List');
            } else {
                $select.show().prop('disabled', false);  
                $input.hide().prop('disabled', true).val('');
                $button.text('Add New Category');
            }
        });
    
    });

</script>
</x-layouts.app>
