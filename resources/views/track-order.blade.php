@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 700px;">
    <h2 class="mb-4">Track Your Order</h2>

    <form action="{{ route('track.search') }}" method="POST">
        @csrf
        <div class="input-group mb-4">
            <input type="text" name="tracking_number" class="form-control"
                   placeholder="Enter Tracking Number" required>
            <button class="btn btn-primary">Track</button>
        </div>
    </form>

    @isset($tracking)
        <div class="card p-4">
            <h4>Tracking Number: <strong>{{ $tracking['tracking_number'] }}</strong></h4>
            <p>Status: <strong>{{ $tracking['status'] }}</strong></p>

            <hr>

            <h5>Tracking History</h5>

            <ul class="timeline">
                @foreach($tracking['history'] as $item)
                    <li>
                        <div class="timeline-content">
                            <h6>{{ $item['status'] }}</h6>
                            <small>{{ $item['date'] }}</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endisset
</div>

<style>
.timeline {
    list-style: none;
    padding: 0;
    position: relative;
}

.timeline:before {
    content: "";
    background: #ddd;
    width: 3px;
    height: 100%;
    position: absolute;
    left: 15px;
    top: 0;
}

.timeline li {
    position: relative;
    margin-bottom: 25px;
    padding-left: 40px;
}

.timeline li:before {
    content: "";
    background: #0d6efd;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    position: absolute;
    left: 8px;
    top: 3px;
}

.timeline-content {
    background: #f8f9fa;
    padding: 12px 18px;
    border-radius: 8px;
}
</style>
@endsection
