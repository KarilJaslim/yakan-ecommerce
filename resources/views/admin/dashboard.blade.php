@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto py-6">

    <!-- Dashboard Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Total Orders -->
        <div class="bg-blue-600 text-white rounded-lg shadow p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold mb-2">Total Orders</h2>
                <p class="text-3xl font-bold" id="totalOrders">{{ $totalOrders ?? 0 }}</p>
            </div>
            <i class="fas fa-shopping-basket fa-2x mt-4"></i>
        </div>

        <!-- Pending Orders -->
        <div class="bg-yellow-500 text-white rounded-lg shadow p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold mb-2">Pending Orders</h2>
                <p class="text-3xl font-bold" id="pendingOrders">{{ $pendingOrders ?? 0 }}</p>
            </div>
            <i class="fas fa-clock fa-2x mt-4"></i>
        </div>

        <!-- Completed Orders -->
        <div class="bg-green-600 text-white rounded-lg shadow p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold mb-2">Completed Orders</h2>
                <p class="text-3xl font-bold" id="completedOrders">{{ $completedOrders ?? 0 }}</p>
            </div>
            <i class="fas fa-check fa-2x mt-4"></i>
        </div>

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-semibold mb-2">Orders by Status</h3>
            <canvas id="ordersStatusChart" class="w-full h-64"></canvas>
        </div>
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-semibold mb-2">Top Selling Products</h3>
            <canvas id="topProductsChart" class="w-full h-64"></canvas>
        </div>
    </div>

    <!-- All Orders Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">All Orders</h2>
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4">Order ID</th>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Products</th>
                        <th class="py-3 px-4">Total</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Payment Status</th>
                        <th class="py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $order->id }}</td>
                            <td class="py-3 px-4">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="py-3 px-4">
                                @foreach ($order->items as $item)
                                    {{ $item->product->name }} x {{ $item->quantity }}
                                    (₱{{ number_format($item->price, 2) }}) <br>
                                @endforeach
                            </td>
                            <td class="py-3 px-4">₱{{ number_format($order->total, 2) }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.orders.quickUpdateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="border rounded px-2 py-1 w-full" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded 
                                    @if($order->payment_status == 'paid') bg-green-600 text-white
                                    @elseif($order->payment_status == 'pending') bg-yellow-500 text-white
                                    @else bg-red-600 text-white @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    let ordersStatusChart, topProductsChart;

    function initCharts(data) {
        // Update summary cards
        document.getElementById('totalOrders').textContent = data.totalOrders;
        document.getElementById('pendingOrders').textContent = data.ordersByStatus.pending || 0;
        document.getElementById('completedOrders').textContent = data.ordersByStatus.completed || 0;

        const ordersStatusCtx = document.getElementById('ordersStatusChart').getContext('2d');
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');

        if (ordersStatusChart) ordersStatusChart.destroy();
        if (topProductsChart) topProductsChart.destroy();

        ordersStatusChart = new Chart(ordersStatusCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(data.ordersByStatus),
                datasets: [{
                    data: Object.values(data.ordersByStatus),
                    backgroundColor: ['#FBBF24', '#22C55E', '#EF4444', '#3B82F6'],
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        topProductsChart = new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: data.topProducts.map(p => p.name),
                datasets: [{
                    label: 'Sold Quantity',
                    data: data.topProducts.map(p => p.order_items_sum_quantity),
                    backgroundColor: '#3B82F6'
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    }

    function fetchMetrics() {
        axios.get("{{ route('admin.dashboard.metrics') }}")
            .then(res => initCharts(res.data))
            .catch(err => console.error(err));
    }

    // Initial load
    fetchMetrics();

    // Refresh every 30 seconds
    setInterval(fetchMetrics, 30000);
</script>
@endsection
