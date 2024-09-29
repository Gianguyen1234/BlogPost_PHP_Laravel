<!-- Floating Category Menu -->
<div id="categorySidebar" class="category-sidebar collapsed">
    <button id="toggleSidebarBtn" class="toggle-btn">☰ </button>
    <h4>Categories</h4>
    <ul class="list-unstyled">
        @foreach ($categories as $category)
        <li>
            <a href="{{ route('category.posts', $category->slug) }}" class="category-link">
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image">
                {{ $category->name }}
            </a>
        </li>
        @endforeach
        <!-- Add 'Uncategorized' option -->
        <li>
            <a href="{{ route('category.uncategorized') }}" class="category-link">Uncategorized</a>
        </li>
    </ul>
</div>

<style>
    /* Floating Menu Styles */
    .category-sidebar {
        position: fixed;
        top: 100px;
        left: 20px;
        width: 250px;
        background-color: #343a40; /* Darker background color */
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.4s ease-in-out; /* Smooth transition for sliding */
    }

    .category-sidebar.collapsed {
        width: 60px; 
        overflow: hidden;
        padding: 15px 5px;
    }

    .category-sidebar.collapsed h4,
    .category-sidebar.collapsed ul {
        display: none;
    }

    /* Sidebar Title */
    .category-sidebar h4 {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
        text-align: center;
        color: white; /* White text for contrast */
    }

    /* Sidebar Links */
    .category-sidebar ul {
        padding: 0;
        margin: 0;
    }

    .category-sidebar ul li {
        margin-bottom: 10px;
    }

    .category-sidebar .category-link {
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        color: #ffc107; /* Changed to yellowish text */
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .category-sidebar .category-link:hover {
        background-color: #ffc107;
        color: black;
    }

    /* Category Image */
    .category-link .category-image {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }

    /* Toggle Button */
    .toggle-btn {
        display: block;
        width: 100%;
        background-color: #ffc107; /* Yellow button */
        color: black;
        text-align: center;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease; /* Added animation */
    }

    .toggle-btn:hover {
        background-color: #e0a800; /* Slightly darker yellow on hover */
        transform: scale(1.1); /* Slight zoom effect on hover */
    }
</style>
