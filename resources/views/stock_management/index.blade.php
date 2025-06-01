<x-layouts.app :title="__('Stock Management')">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Stock Management</h1>
        <a href="{{ route('editOrcreate') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded shadow transition">
            + Add Item
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-800 dark:text-gray-200">
            <thead class="bg-blue-600 text-white dark:bg-blue-700">
                <tr>
                    <th class="py-3 px-4">Item Name</th>
                    <th class="py-3 px-4">Stock</th>
                    <th class="py-3 px-4">Price</th>
                    <th class="py-3 px-4">Image</th>
                    <th class="py-3 px-4">Category</th>
                    <th class="py-3 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="py-3 px-4">{{ $item->item_name }}</td>
                        <td class="py-3 px-4">{{ $item->stok }}</td>
                        <td class="py-3 px-4">${{ number_format($item->price, 2) }}</td>
                        <td class="py-3 px-4">
                            @if($item->path_item)
                                <img src="{{ asset('storage/' . $item->path_item) }}" alt="Image" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 dark:text-gray-500">No image</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">{{ $item->category->category_item_name ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('editOrcreate', $item->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500 dark:text-gray-400">
                            No items found.
                            <a href="{{ route('editOrcreate') }}"
                                class="ml-3 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                + Add Your First Item
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
