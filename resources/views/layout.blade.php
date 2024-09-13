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

    <!-- Custom CSS for Navbar and Search -->
    <style>
        /* Modern Navbar Styles */
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

        /* Clean Search Form */
        .search-form {
            display: flex;
            align-items: center;
            position: relative;
        }

        /* Search input */
        .search-form input {
            width: 280px;
            padding: 10px 20px;
            border-radius: 50px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
            font-size: 1rem;
            color: #495057;
        }

        /* Boxicon Search Button */
        .search-form button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            color: #6c757d;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .search-form button:hover {
            color: #343a40;
        }

        /* Focus on input */
        .search-form input:focus {
            border-color: #6c757d;
            box-shadow: none;
        }

        /* Button Styling for Login/Sign-Up */
        .btn-login, .btn-signup {
            margin-left: 10px;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .btn-login {
            background-color: transparent;
            color: #ffffff;
            border: 1px solid #ffffff;
        }

        .btn-login:hover {
            background-color: #ffffff;
            color: #343a40;
        }

        .btn-signup {
            background-color: #28a745;
            color: #ffffff;
            border: none;
        }

        .btn-signup:hover {
            background-color: #218838;
            color: #ffffff;
        }
    </style>
</head>

<body>

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
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>

                <!-- Dropdown Menu for Categories -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Tech</a>
                        <a class="dropdown-item" href="#">Lifestyle</a>
                        <a class="dropdown-item" href="#">Travel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Other</a>
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

            <!-- Login and Sign-Up Buttons -->
            <a href="{{ url('/login') }}" class="btn btn-login">Login</a>
            <a href="{{ url('/register') }}" class="btn btn-signup">Sign Up</a>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')  
    </div>

    <!--  Bootstrap's JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
