@extends('layout')

@section('title', 'About Us')

@section('content')

    <!-- About Us Section -->
    <div class="jumbotron">
        <h1 class="display-4">About Us</h1>
        <p class="lead">Welcome to MyBlog! We are dedicated to bringing you the latest updates, engaging content, and insightful articles on various topics.</p>
        <hr class="my-4">
        <p>Our team of writers and editors work tirelessly to provide high-quality content that is both informative and entertaining. Whether you're interested in technology, lifestyle, travel, or more, you'll find something of interest here.</p>
        <p>We believe in creating a community where readers can connect, share ideas, and explore new topics. Feel free to reach out to us with any questions or feedback!</p>
    </div>

    <!-- Team Section -->
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Meet the Team</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">John Doe</h5>
                    <p class="card-text">John is the founder and chief editor of MyBlog. With a passion for technology and writing, John brings a wealth of knowledge and experience to the team.</p>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Jane Smith</h5>
                    <p class="card-text">Jane is a senior writer with a keen interest in lifestyle and travel. Her engaging articles and personal experiences make her a valuable part of the team.</p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection