<x-layouts.app :title="__('Stock Management')">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-gray-600 dark:text-gray-400">Daftar produk toko</p>
        </div>

        <!-- Livewire Component -->
        <livewire:stock-management />
    </div>
</x-layouts.app>
