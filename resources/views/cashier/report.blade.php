<x-layouts.app :title="__('Sales Report')">
    
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4 text-neutral-800 dark:text-neutral-100">Sales Report</h2>

    <form method="GET" class="mb-6 flex gap-4 items-center">
        <select name="range" class="p-2 rounded border dark:bg-neutral-800 dark:text-white">
            <option value="week" {{ request('range') === 'week' ? 'selected' : '' }}>This Week</option>
            <option value="month" {{ request('range') === 'month' ? 'selected' : '' }}>This Year (Monthly)</option>
            <option value="year" {{ request('range') === 'year' ? 'selected' : '' }}>Last 6 Years</option>
        </select>
        <input type="number" name="year" value="{{ request('year', now()->year) }}" class="p-2 rounded border dark:bg-neutral-800 dark:text-white" placeholder="Year">
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
    </form>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-neutral-800 dark:text-white mb-2">Most Sold Items (This Week)</h3>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-neutral-800 dark:text-white mb-2">Income</h3>
            <canvas id="barChart"></canvas>
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
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => '$ ' + value.toLocaleString()
                    }
                }
            }
        }
    });
</script>
</x-layouts.app >