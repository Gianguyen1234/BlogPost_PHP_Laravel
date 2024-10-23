@extends('admin.dashboard')

@section('title', 'User Analytics')

@section('content')

<div class="container mt-4">
    <div class="row g-4 justify-content-center">
        <div class="col-3">
            <div class="card shadow-sm border-0">
                <div class="icon-container icon-black rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                    <i class="material-icons text-white">account_balance_wallet</i>
                </div>
                <div class="card-body text-center pt-5">
                    <div class="title">Today's Money</div>
                    <div class="value">$53k</div>
                    <div class="comparison positive">+55% than last week</div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow-sm border-0">
                <div class="icon-container icon-pink rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                    <i class="material-icons text-white">people</i>
                </div>
                <div class="card-body text-center pt-5">
                    <div class="title">Today's Users</div>
                    <div class="value">{{ $totalUsers }}</div>
                    <div class="comparison positive">+3% than last month</div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow-sm border-0">
                <div class="icon-container icon-green rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                    <i class="material-icons text-white">person_add</i>
                </div>
                <div class="card-body text-center pt-5">
                    <div class="title">New Clients</div>
                    <div class="value">{{ $uniqueVisitors }}</div>
                    <div class="comparison negative">-2% than yesterday</div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow-sm border-0">
                <div class="icon-container icon-blue rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                    <i class="material-icons text-white">shopping_cart</i>
                </div>
                <div class="card-body text-center pt-5">
                    <div class="title">Sales</div>
                    <div class="value">$103,430</div>
                    <div class="comparison positive">+5% than yesterday</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 justify-content-center mt-3">
    <div class="col-4 mt-5">
        <div class="card shadow-sm border-0">
            <div class="icon-container icon-black rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                <i class="material-icons text-white">theater_comedy</i>
            </div>
            <div class="card-body text-center pt-5">
                <div class="title">Most Viewed Post</div>
                <p class="card-text">{{ $topPost->post->title }} ({{ $topPost->views_count }} views)</p>
                <div class="comparison positive">+10% than last month</div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <div class="card shadow-sm border-0">
            <div class="icon-container icon-green rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                <i class="material-icons text-white">theater_comedy</i>
            </div>
            <div class="card-body text-center pt-5">
                <div class="title">Most Viewed Post</div>
                <p class="card-text">{{ $topPost->post->title }} ({{ $topPost->views_count }} views)</p>
                <div class="comparison positive">+10% than last month</div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <div class="card shadow-sm border-0">
            <div class="icon-container icon-pink rounded-circle d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle">
                <i class="material-icons text-white">theater_comedy</i>
            </div>
            <div class="card-body text-center pt-5">
                <div class="title">Most Viewed Post</div>
                <p class="card-text">{{ $topPost->post->title }} ({{ $topPost->views_count }} views)</p>
                <div class="comparison positive">+10% than last month</div>
            </div>
        </div>
    </div>
</div>

<h2>Analytics</h2>
    <canvas id="lineChart"></canvas>

@endsection

<style>
    .icon-container {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
    }

    .icon-black {
        background-color: #333;
    }

    .icon-pink {
        background-color: #e91e63;
    }

    .icon-green {
        background-color: #4caf50;
    }

    .icon-blue {
        background-color: #2196f3;
    }

    .card-body .title {
        font-size: 14px;
        color: #757575;
    }

    .card-body .value {
        font-size: 24px;
        font-weight: bold;
        color: #212121;
        margin-top: 4px;
    }

    .card-body .comparison {
        font-size: 12px;
        margin-top: 8px;
    }

    .positive {
        color: #4caf50;
    }

    .negative {
        color: #f44336;
    }
</style>