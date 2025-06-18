<x-layouts.app :title="__('Sales Report')">
<div class="min-h-screen bg-[#f3ffe4] p-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-[#225E00]">Sales Report</h2>
        <form method="GET" class="mb-8 flex flex-wrap gap-4 items-center">
            <select name="range" class="p-3 rounded-lg border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-[#225E00]">
                <option value="week" {{ request('range') === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('range') === 'month' ? 'selected' : '' }}>This Year (Monthly)</option>
                <option value="year" {{ request('range') === 'year' ? 'selected' : '' }}>Last 6 Years</option>
            </select>
            <input type="number" name="year" value="{{ request('year', now()->year) }}" class="p-3 rounded-lg border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-[#225E00] w-32" placeholder="Year">
            <button class="px-6 py-3 bg-[#225E00] text-white rounded-lg font-semibold shadow hover:bg-green-800 transition">Filter</button>
        </form>
        <div class="grid gap-8 md:grid-cols-2">
            <div class="bg-white p-6 rounded-2xl shadow-md border border-[#e0eeda]">
                <h3 class="text-xl font-semibold text-[#225E00] mb-4">Most Sold Items ({{ request('range') === 'month' ? 'This Year' : (request('range') === 'year' ? 'Last 6 Years' : 'This Week') }})</h3>
                <canvas id="pieChart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-md border border-[#e0eeda]">
                <h3 class="text-xl font-semibold text-[#225E00] mb-4">Income</h3>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: @json($pieLabels),
            datasets: [{
                data: @json($pieCounts),
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#6366f1']
            }]
        }
    });

    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($incomeLabels),
            datasets: [{
                label: 'Income',
                data: @json($incomeData),
                backgroundColor: '#225E00'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rp ' + value.toLocaleString()
                    }
                }
            }
        }
    });
</script>
</x-layouts.app>
