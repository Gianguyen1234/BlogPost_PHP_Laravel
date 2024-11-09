<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <title>@yield('title', 'Blog Post')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml"> -->
    <link rel="icon" type="image/png" href="images/logo/bloglogo.png" sizes="32x32">

    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include Summernote CSS and JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">



</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- Blog Brand/Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">

            BLOGPOST
        </a>
        <!-- Navbar Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            @include('partials.navbar')
            <!-- Search Form -->
            <form class="search-form my-2 my-lg-0" action="{{ url('/search') }}" method="GET">
                <input class="form-control" type="search" name="query" placeholder="Search..." aria-label="Search" required>
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
            <a href="{{  route('userprofile.show') }}" class="btn btn-dashboard">User Profile</a>
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
    @include('partials.floatingmenu')

    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Include Footer Partial -->
    @include('partials.footer')

    <!--  Bootstrap's JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.0.6/markdown-it.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.1.3/lazyload.min.js"></script>

    <!-- <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300, // Set the height of the editor
                toolbar: [
                    // Customize toolbar with code button and other options
                    ['style', ['bold', 'italic', 'underline']],
                    ['insert', ['picture', 'link']],
                    ['code', ['codeview']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // Handle image upload here if needed
                    }
                }
            });
        });
    </script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Markdown rendering using markdown-it
            var md = window.markdownit({
                html: true,
                highlight: function(str, lang) {
                    if (lang && hljs.getLanguage(lang)) {
                        try {
                            return hljs.highlight(str, {
                                language: lang
                            }).value;
                        } catch (__) {}
                    }
                    try {
                        return hljs.highlightAuto(str).value;
                    } catch (__) {}
                    return '';
                }
            });

            // Insert code block when "Add Code Block" button is clicked
            document.getElementById('add-code-block').addEventListener('click', function() {
                const contentArea = document.getElementById('content');
                const codeTemplate = "```language\n// Paste your code here\n```";

                // Insert code block at the cursor position
                const cursorPosition = contentArea.selectionStart;
                const content = contentArea.value;
                contentArea.value = content.slice(0, cursorPosition) + codeTemplate + content.slice(cursorPosition);

                // Optionally, move cursor between the backticks for editing
                contentArea.focus();
                contentArea.setSelectionRange(cursorPosition + 3, cursorPosition + 11);
            });

            // Convert Markdown content to HTML when "Convert to HTML" button is clicked
            document.getElementById('convert-button').addEventListener('click', function() {
                const content = document.getElementById('content').value;
                const htmlContent = md.render(content);
                document.getElementById('render-here').innerHTML = htmlContent;

                // Apply syntax highlighting to any code blocks
                document.querySelectorAll('pre code').forEach((block) => {
                    hljs.highlightElement(block);
                });
            });
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
            $(target).collapse('show');
            $(target).find('textarea').focus();
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
                                this.querySelector('.upvote-count').innerText = data.upvotes;
                            }
                        });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show progress bar when navigating away
            NProgress.configure({
                showSpinner: false
            });

            // Show progress when page starts loading
            window.addEventListener('beforeunload', function() {
                NProgress.start();
            });

            // Hide progress when page fully loads
            window.addEventListener('load', function() {
                NProgress.done();
            });

            // Attach NProgress to any AJAX requests (if using jQuery)
            $(document).ajaxStart(function() {
                NProgress.start();
            }).ajaxStop(function() {
                NProgress.done();
            });
            // Optional: Trigger NProgress on link clicks
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    NProgress.start();
                });
            });
        });
    </script>

    <script>
        document.getElementById('like-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default behavior of the button

            const likeUrl = this.getAttribute('data-like-url'); // Get the like URL from the button

            if (likeUrl) {
                fetch(likeUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token for security
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const likeCount = document.getElementById('like-count');
                            const likeIcon = this.querySelector('i');

                            // Update like count and icon color
                            likeCount.innerText = data.likes_count;

                            if (data.liked) {
                                likeIcon.classList.remove('text-muted');
                                likeIcon.classList.add('text-danger'); // Change to red if liked
                            } else {
                                likeIcon.classList.remove('text-danger');
                                likeIcon.classList.add('text-muted'); // Change back to muted if unliked
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
    <script>
        var lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazyload"
        });
    </script>

</body>

</html>