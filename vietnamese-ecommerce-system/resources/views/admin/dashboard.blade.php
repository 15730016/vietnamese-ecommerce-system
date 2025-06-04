@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">Users</h2>
        <p class="text-3xl">{{ $userCount ?? 0 }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">Orders</h2>
        <p class="text-3xl">{{ $orderCount ?? 0 }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">Products</h2>
        <p class="text-3xl">{{ $productCount ?? 0 }}</p>
    </div>
</div>

<div class="mt-8 bg-white p-4 rounded shadow">
    <canvas id="ordersChart" height="100"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($orderChartLabels ?? []) !!},
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($orderChartData ?? []) !!},
                    backgroundColor: 'rgba(59, 181, 74, 0.2)',
                    borderColor: '#3AB54A',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    });
</script>
@endsection
