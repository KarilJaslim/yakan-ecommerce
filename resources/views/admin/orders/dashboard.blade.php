@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Dashboard Metrics -->
    <div class="row mb-5">
        <!-- Total Orders -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <h2 id="total-orders" class="display-4">{{ $totalOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Orders Summary -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <div id="order-summary">
                        @if(!empty($ordersByStatus))
                            @foreach($ordersByStatus as $status => $count)
                                <p class="mb-1"><strong>{{ ucfirst($status) }}:</strong> {{ $count }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Placeholder for future metric -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Top Product Sold</h5>
                    @if(!empty($topProducts[0]))
                        <p>{{ $topProducts[0]->name ?? 'N/A' }} - {{ $topProducts[0]->order_items_sum_quantity ?? 0 }} sold</p>
                    @else
                        <p>N/A</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Top Selling Products Table -->
    <h3 class="mb-3">Top Selling Products</h3>
    <div class="table-responsive mb-5">
        <table class="table table-striped table-bordered" id="top-products-table">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->order_items_sum_quantity ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Orders Table -->
    <h3 class="mb-3">All Orders</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                        <td>₱{{ number_format($order->total, 2) }}</td>
                        <td>
                            <select class="status form-select form-select-sm" data-id="{{ $order->id }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>
                        <td>
                            <select class="payment_status form-select form-select-sm" data-id="{{ $order->id }}">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </td>
                        <td>
                            <button class="update-btn btn btn-sm btn-primary" data-id="{{ $order->id }}">Update</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- jQuery AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    function refreshDashboard() {
        $.get("{{ route('admin.orders.metrics') }}", function(data) {
            $('#total-orders').text(data.totalOrders);

            let summaryHtml = '';
            $.each(data.ordersByStatus, function(status, count) {
                summaryHtml += '<p class="mb-1"><strong>' + status.charAt(0).toUpperCase() + status.slice(1) + ':</strong> ' + count + '</p>';
            });
            $('#order-summary').html(summaryHtml);
        });
    }

    $('.update-btn').click(function() {
        let id = $(this).data('id');
        let status = $('select.status[data-id="'+id+'"]').val();
        let payment_status = $('select.payment_status[data-id="'+id+'"]').val();

        $.ajax({
            url: '/admin/orders/' + id + '/update-status',
            type: 'POST',
            data: {
                status: status,
                payment_status: payment_status,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                alert(res.message);
                refreshDashboard();
            },
            error: function(err) {
                alert('Error updating order. Please try again.');
            }
        });
    });

});
</script>
@endsection
