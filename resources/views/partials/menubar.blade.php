<div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
    <div class="card-body">
        <h5 class="card-title enhanced-title">Categories</h5>
        <ul class="list-group list-group-flush">
            @foreach($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <!-- Display category image -->
                    <img src="{{ asset( $category->image) }}" alt="{{ $category->name }} image" style="width: 40px; height: 40px; object-fit: cover; margin-right: 15px;">
                    
                    <!-- Category name -->
                    <a href="{{ route('category.posts', $category->slug) }}" class="post-title" style="text-decoration: none;">{{ $category->name }}</a>
                </div>
                <i class='bx bx-chevron-right' style="font-size: 1.5rem; color: #ff4d4f""></i> <!-- Right arrow icon -->
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
    <div class="card-body">
        <h5 class="card-title enhanced-title">Latest News</h5>
        <ul class="list-group list-group-flush">
            @foreach($latestPosts as $latestPost)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <!-- Decorated post number -->
                    <span class="number-badge me-3">{{ $loop->iteration }}</span>
                    
                    <!-- Post title -->
                    <a href="{{ route('posts.show', $latestPost->slug) }}" class="post-title" style="text-decoration: none;">{{ $latestPost->title }}</a>
                </div>                
                <i class='bx bx-chevron-right'  style="font-size: 1.5rem; color: #ff4d4f"></i> <!-- Right arrow icon -->
            </li>
            @endforeach
        </ul>
    </div>
</div>
<style>
.number-badge {
    display: inline-flex; /* Use flexbox for centering */
    justify-content: center; /* Center the content horizontally */
    align-items: center; /* Center the content vertically */
    background: linear-gradient(135deg, #ff4d4f, #ff8080); /* Love gradient: bright red to soft pink */
    color: white; /* White text for contrast */
    font-size: 1.4rem; /* Larger font size */
    font-weight: bold; /* Bold text for emphasis */
    padding: 10px 18px; /* Padding for a balanced look */
    border-radius: 12px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for a subtle 3D effect */
    min-width: 45px; /* Ensure the badge is always at least this wide */
    height: 45px; /* Consistent height */
    text-align: center; /* Center the number horizontally */
    margin-right: 15px;
    transition: box-shadow 0.3s ease-in-out; /* Transition only the shadow on hover */
}

.number-badge:hover {
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3); /* Darken the shadow on hover for a subtle effect */
}
.enhanced-title {
    font-size: 2.5rem; /* Increase the font size */
    font-weight: bold; /* Make it bold */
    color: #d9534f; /* Use a vibrant color (Bootstrap danger color) */
    background-color: rgba(255, 255, 255, 0.8); /* Slightly translucent white background */
    padding: 10px 15px; /* Add padding for spacing */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 15px; /* Space below the title */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
    position: relative; /* Position for pseudo-element */
}

.enhanced-title::after {
    content: '';
    display: block;
    width: 50px; /* Width of the underline */
    height: 3px; /* Height of the underline */
    background-color: #d9534f; /* Underline color */
    margin-top: 5px; /* Space above the underline */
    position: absolute; /* Positioning for the underline */
    left: 0; /* Align with the left */
}

.post-title {
    color: #ff4d4f; /* Love color for the title */
    font-size: 1.2rem; /* Larger font size for emphasis */
    font-weight: bold; /* Bold text for importance */
    position: relative; /* Positioning for the hover effect */
    padding: 5px 0; /* Padding for a little spacing */
    transition: color 0.3s ease, transform 0.3s ease; /* Smooth transitions for color and transform */
}

.post-title:hover {
    color: #ff8080; /* Softer pink color on hover */
    transform: translateY(-2px); /* Slight upward movement on hover */
}

/* Optional: Add a bottom border on hover */
.post-title::after {
    content: '';
    display: block;
    width: 100%;
    height: 2px; /* Height of the underline */
    background-color: #ff4d4f; /* Color of the underline */
    position: absolute;
    left: 0;
    bottom: -5px; /* Position it below the text */
    transform: scaleX(0); /* Start hidden */
    transition: transform 0.3s ease; /* Transition for the underline effect */
}

.post-title:hover::after {
    transform: scaleX(1); /* Show the underline on hover */
}

</style>



