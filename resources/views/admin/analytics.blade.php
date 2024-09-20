<!-- resources/views/admin/analytics.blade.php -->

@extends('admin.dashboard')

@section('title', 'User Analytics')

@section('content')
    <!-- Total Users Section -->
    <div class="total-users mb-4">
        <h2>Total Users Visit</h2>
        <p class="fs-3" id="totalUserCount">{{ $totalUsers }}</p> <!-- Dynamically showing total users -->
    </div>

    <h2>Analytics</h2>
    <canvas id="lineChart"></canvas>
@endsection
