<!-- resources/views/admin/analytics.blade.php -->

@extends('admin.dashboard')

@section('title', 'User Analytics')

@section('content')
<!-- Total Users Section -->
<div class="total-users mb-4 text-center">
    <h2 class="text-dark mb-4">Visitor Statistics</h2>

    <div class="statistics-container">
        <div class="stat-card">
            <h3 id="totalUserCount" class="stat-number">{{ $totalUsers }}</h3>
            <p class="stat-label">Total Visits</p>
        </div>

        <div class="stat-card">
            <h3 id="uniqueVisitorCount" class="stat-number">{{ $uniqueVisitors }}</h3>
            <p class="stat-label">Unique Visitors</p>
        </div>
    </div>
</div>



    <h2>Analytics</h2>
    <canvas id="lineChart"></canvas>
@endsection
<style>
    .total-users {
    background-color: #ffffff; /* White background for a clean look */
    border-radius: 15px; /* Rounded corners */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    padding: 30px; /* Add padding for spacing */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth transitions */
}

.total-users:hover {
    transform: translateY(-5px); /* Slight lift on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

h2 {
    font-size: 2.5rem; /* Larger title */
    font-weight: bold; /* Bold title */
}

.statistics-container {
    display: flex; /* Flexbox for alignment */
    justify-content: center; /* Center horizontally */
    gap: 30px; /* Space between cards */
}

.stat-card {
    background-color: #f0f4f8; /* Light background for cards */
    border-radius: 10px; /* Rounded corners */
    padding: 20px; /* Padding inside cards */
    flex: 1; /* Equal size cards */
    text-align: center; /* Center text */
    transition: transform 0.3s; /* Smooth transition */
}

.stat-card:hover {
    transform: scale(1.05); /* Slightly enlarge card on hover */
}

.stat-number {
    font-size: 2.5rem; /* Large font size for numbers */
    font-weight: bold; /* Bold numbers */
    color: #333; /* Dark text color */
}

.stat-label {
    font-size: 1.2rem; /* Smaller label font size */
    color: #666; /* Muted color for labels */
    margin-top: 10px; /* Space above labels */
}

</style>