<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Post')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- {{-- CKEditor CDN --}} -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom CSS for Navbar -->
    <style>
        /* Navbar */
        .navbar {
            background-color: #343a40;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.7rem;
            font-weight: bold;
            color: #ffffff;
        }

        .nav-link {
            color: #ffffff;
            margin-right: 15px;
        }

        .nav-link:hover {
            color: #d4d4d4;
            border-bottom: 2px solid #ffffff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- Blog Brand/Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">MyBlog</a>

        <!-- Navbar Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
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

            <!-- Search Form -->
            <form class="search-form my-2 my-lg-0">
                <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                <button type="submit">
                    <i class='bx bx-search'></i>
                </button>
            </form>

            <!-- Authentication Links -->
            @guest
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-signup">Sign Up</a>
            @else
            <!-- Link to Profile Edit -->
            <a href="{{ route('profile.edit') }}" class="btn btn-login">{{ Auth::user()->name }}</a>
            <!-- link for usertype -->
            @if(Auth::user()->usertype == 'admin')
            <!-- Link to Admin Dashboard for Admin Users -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-admin">Admin Dashboard</a>
            @else
            <!-- Link for Regular Users (optional, if needed) -->
            <a href="{{ url('/') }}" class="btn btn-dashboard">Default User</a>
            @endif


            <!-- Logout Button -->
            <a href="{{ route('logout') }}" class="btn btn-signup"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endguest


        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Include Footer Partial -->
    @include('partials.footer')

    <!--  Bootstrap's JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js" async></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                },
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'ckfinder', 'imageUpload', '|',
                    'undo', 'redo', '|',
                    'bulletedList', 'numberedList', 'blockQuote', '|',
                    'insertTable', 'mediaEmbed', '|',

                ],

            })
            .catch(error => {
                console.error(error);
            });
    </script>


    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            showConfirmButton: true,
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first() }}',
        });
    </script>
    @endif

    <!-- categories side bar open -->
    <script>
        document.getElementById('toggleSidebarBtn').addEventListener('click', function() {
            var sidebar = document.getElementById('categorySidebar');
            sidebar.classList.toggle('collapsed');
        });
    </script>

    <!-- replies comments box -->
    <script>
        $(document).on('click', '.btn-link', function() {
            var target = $(this).attr('href');
            $(target).collapse('show'); // Ensure the form is visible
            $(target).find('textarea').focus(); // Focus on the reply form textarea
        });
    </script>

    <!-- upvote button -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const upvoteButtons = document.querySelectorAll('.upvote-button');

            upvoteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-id');
                    fetch(`/comments/${commentId}/upvote`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.querySelector('.upvote-count').innerText = data.upvotes; // Update upvote count
                            }
                        });
                });
            });
        });
    </script>



</body>

</html>