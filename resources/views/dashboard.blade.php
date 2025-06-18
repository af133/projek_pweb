<x-layouts.app :title="__('Dashboard')">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col gap-8 w-full h-full">
                
                <!-- Welcome Section -->
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        Selamat datang, {{ Auth::user()->name }} 👋
                    </p>
                </div>

                <!-- Feature Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                    
                   

                    <!-- Transaksi Hari Ini -->
                    <a href="{{ route('order_history') }}" 
                       class="bg-green-50 dark:bg-green-950 border border-green-200 dark:border-green-800 hover:bg-green-100 dark:hover:bg-green-900 rounded-xl shadow-sm transition-all duration-200 hover:shadow-lg hover:scale-105 cursor-pointer group">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-xl bg-green-50 dark:bg-green-950 border-green-200 dark:border-green-800 border-2 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-1 group-hover:opacity-80 transition-opacity">
                                        Jumlah Transaksi Hari Ini
                                    </h3>
                                    <p class="text-sm text-green-700 dark:text-green-300 leading-relaxed">
                                        Total transaksi: {{ $totalTransaksiHariIni }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Pemasukan Hari Ini -->
                    <a href="{{ route('report') }}" 
                       class="bg-amber-50 dark:bg-amber-950 border border-amber-200 dark:border-amber-800 hover:bg-amber-100 dark:hover:bg-amber-900 rounded-xl shadow-sm transition-all duration-200 hover:shadow-lg hover:scale-105 cursor-pointer group">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-xl bg-amber-50 dark:bg-amber-950 border-amber-200 dark:border-amber-800 border-2 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-amber-900 dark:text-amber-100 mb-1 group-hover:opacity-80 transition-opacity">
                                        Pemasukan Hari Ini
                                    </h3>
                                    <p class="text-sm text-amber-700 dark:text-amber-300 leading-relaxed">
                                        Total uang masuk: {{ $totalPemasukanHariIni }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                  

                    <!-- Jumlah Barang -->
                    <a href="{{ route('stock_management') }}" 
                       class="bg-rose-50 dark:bg-rose-950 border border-rose-200 dark:border-rose-800 hover:bg-rose-100 dark:hover:bg-rose-900 rounded-xl shadow-sm transition-all duration-200 hover:shadow-lg hover:scale-105 cursor-pointer group">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-xl bg-rose-50 dark:bg-rose-950 border-rose-200 dark:border-rose-800 border-2 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-6 h-6 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                @if ($barangStokRendah<=10)
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-rose-900 dark:text-rose-100 mb-1 group-hover:opacity-80 transition-opacity">
                                        Peringatan! Cepat cek
                                    </h3>
                                    <p class="text-sm text-rose-700 dark:text-rose-300 leading-relaxed">
                                        {{ $barangStokRendah }} barang hampir habis
                                    </p>
                                </div>
                                @else
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-rose-900 dark:text-rose-100 mb-1 group-hover:opacity-80 transition-opacity">
                                        Tidak ada barang hampir habis
                                    </h3>
                                    
                                </div>
                                @endif
                            </div>
                        </div>
                    </a>

                </div>

                <!-- Quick Stats Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm">Total Transaksi</p>
                                    <p class="text-3xl font-bold">{{ $totalTransaksi ?? '0' }}</p>
                                </div>
                                <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl shadow-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm">Total Pendapatan</p>
                                    <p class="text-3xl font-bold">{{ $totalPendapatan ?? 'Rp 0' }}</p>
                                </div>
                                <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl shadow-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm">Total Produk</p>
                                    <p class="text-3xl font-bold">{{ $totalProduk ?? '0' }}</p>
                                </div>
                                <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-3">
                            @forelse($aktivitasTerbaru ?? [] as $aktivitas)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $aktivitas }}</span>
                                </div>
                            @empty
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300">Barang baru ditambahkan: Laptop Dell</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300">Transaksi berhasil: Rp 2.500.000</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300">Stok rendah: Mouse Wireless</span>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('editOrcreate') }}" class="flex items-center gap-2 p-3 bg-blue-50 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-sm font-medium">Tambah Barang</span>
                            </a>
                            <a href="{{ route('order_history') }}" class="flex items-center gap-2 p-3 bg-green-50 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-100 dark:hover:bg-green-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
                                </svg>
                                <span class="text-sm font-medium">Buat Transaksi</span>
                            </a>
                            <a href="{{ route('report') }}" class="flex items-center gap-2 p-3 bg-purple-50 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span class="text-sm font-medium">Lihat Laporan</span>
                            </a>
                            <a href="{{ route('stock_management') }}" class="flex items-center gap-2 p-3 bg-amber-50 dark:bg-amber-900 text-amber-700 dark:text-amber-300 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <span class="text-sm font-medium">Kelola Stok</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
