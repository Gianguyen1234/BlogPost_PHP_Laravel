@extends('layout')

@section('title', 'About Us')

@section('content')

    <!-- About Us Section -->
    <div class="jumbotron bg-light p-5 rounded shadow-lg position-relative overflow-hidden">
    <!-- Background Image / Gradient -->
    <div class="bg-overlay position-absolute w-100 h-100 top-0 start-0"></div>

    <!-- Main Content -->
    <div class="content text-center">
        <h1 class="display-4 fw-bold mb-3 text-dark">About Us</h1>
        <p class="lead text-dark-50 mb-5 mx-auto" style="max-width: 700px;">Welcome to MyBlog! We are dedicated to bringing you the latest updates, engaging content, and insightful articles on various topics.</p>
        <hr class="my-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="text-muted">Our team of writers and editors work tirelessly to provide high-quality content that is both informative and entertaining. Whether you're interested in technology, lifestyle, travel, or more, you'll find something of interest here.</p>
                <p class="text-muted">We believe in creating a community where readers can connect, share ideas, and explore new topics. Feel free to reach out to us with any questions or feedback!</p>
            </div>
        </div>

     
    </div>
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
<style>
    /* Overlay for background */
.bg-overlay {
    background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
    opacity: 0.2;
    z-index: -1;
}

/* Typography Adjustments */
.jumbotron .display-4 {
    font-family: 'Poppins', sans-serif; /* Optional: Use a modern Google Font */
    color: #333;
}

.jumbotron .lead {
    font-size: 1.25rem;
    color: #555;
    line-height: 1.8;
}

.jumbotron p {
    font-size: 1.1rem;
}


/* Animation */
.content {
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(30px); }
    100% { opacity: 1; transform: translateY(0); }
}

</style>