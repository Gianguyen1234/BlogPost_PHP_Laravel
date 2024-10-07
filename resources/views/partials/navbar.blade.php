<ul class="navbar-nav mr-auto">
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/posts') }}">Blog</a></li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('posts/create') }}">
            <i class='bx bx-plus'></i> Create
        </a>
    </li>
    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>

    <!-- Dropdown Menu for Categories -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($categories as $category)
            <a class="dropdown-item d-flex align-items-center" href="{{ url('/category', $category->slug) }}">
                <!-- Display the category image -->
                @if ($category->image)
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-dropdown-image">
                @endif
                <span class="category-name">{{ $category->name }}</span>
            </a>
            @endforeach
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('/category/uncategorized') }}">Uncategorized</a>
        </div>
    </li>
</ul>