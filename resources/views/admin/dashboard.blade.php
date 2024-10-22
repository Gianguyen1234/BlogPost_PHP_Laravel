<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{url('css/form.css')}}">
    <style>
        #lineChart {
            width: 100%;
            height: 400px;
        }

        .total-users {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .total-users h2 {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-light">
            <div class="sidebar-header d-flex justify-content-between align-items-center p-3">
                <h4 class="mb-0">Sidebar</h4>
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{route('admin.analytics')}}" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
                <!-- Manage Category -->
                <a href="#manageCategoriesDropdown" class="list-group-item list-group-item-action text-light" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="bi bi-tags me-2"></i> Manage Category
                    <i class="bi bi-chevron-down float-end"></i>
                </a>
                <div class="collapse" id="manageCategoriesDropdown">
                    <div class="list-group">
                        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action text-light">View All Categories</a>
                        <a href="{{ route('admin.categories.create') }}" class="list-group-item list-group-item-action text-light">Create New Category</a>
                    </div>
                </div>

                <!-- Manage Posts -->
                <a href="#managePostsDropdown" class="list-group-item list-group-item-action text-light" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="bi bi-file-post me-2"></i> Manage Posts
                    <i class="bi bi-chevron-down float-end"></i>
                </a>
                <div class="collapse" id="managePostsDropdown">
                    <div class="list-group">
                        <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action text-light">View All Posts</a>
                        <a href="{{ route('admin.posts.create') }}" class="list-group-item list-group-item-action text-light">Create New Post</a>
                        <a href="{{ route('admin.posts.draft') }}" class="list-group-item list-group-item-action text-light">User Pending Post</a>
                    </div>
                </div>

                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-person me-2"></i> Users
                </a>
                <a href="#" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-chat-dots me-2"></i> Messages
                </a>
                <a href="#" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-bookmark me-2"></i> Bookmark
                </a>
                <a href="#" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-file-earmark me-2"></i> Files
                </a>
                <a href="#" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-bar-chart me-2"></i> Stats
                </a>
                <a href="#" class="list-group-item list-group-item-action text-light"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <header class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary d-lg-none" id="sidebarToggleMobile">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h1 class="ms-3 text-wrap bg-primary text-white p-2">Dashboard</h1>
                </div>
                <!-- Right-side Icons (Notification & Toggle Dracula Mode) -->
                <div class="d-flex align-items-center ">
                    <div class="dropdown me-3">
                        <!-- Notification Icon -->
                        <button class="btn btn-light position-relative" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-4" ></i>
                            <!-- Notification Badge -->
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3 <!-- Example notification count -->
                            </span>
                        </button>
                        <!-- Notification dropdown content -->
                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="notificationDropdown">
                            <li><strong>Notifications</strong></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="#" class="dropdown-item">New message from John</a></li>
                            <li><a href="#" class="dropdown-item">Server maintenance scheduled</a></li>
                            <li><a href="#" class="dropdown-item">Update available</a></li>
                        </ul>
                    </div>
                    <!-- Add a toggle button in your header or sidebar -->
                    <button class="btn btn-primary ms-5" onclick="toggleDraculaMode()">
                        <i class="bi bi-moon-stars me-2"></i> <!-- Icon for dark mode -->
                        Dracula Mode
                    </button>


            </header>
            <div class="container-fluid p-4">

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap and Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const sidebar = document.getElementById('sidebar');
            const pageContentWrapper = document.getElementById('page-content-wrapper');

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                pageContentWrapper.classList.toggle('sidebar-open');
            });

            sidebarToggleMobile.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                pageContentWrapper.classList.toggle('sidebar-open');
            });
            const ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'User Visits',
                        data: [12, 19, 3, 5, 2, 3, 7, 10, 15, 12, 8, 5], // Example data
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
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

    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }

        function confirmReject(postId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the reject form
                    document.getElementById('rejectForm-' + postId).submit();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#addTable').DataTable({
                // Enable searching and pagination
                paging: true,
                searching: true,
                ordering: true,
                // Optional: Customize language settings if needed
                language: {
                    search: "Search:",
                    lengthMenu: "Display _MENU_ users per page",
                    info: "Showing page _PAGE_ of _PAGES_",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });

        });
    </script>
    <script>
        // Check for saved theme in localStorage
        if (localStorage.getItem('theme-mode') === 'dracula') {
            document.body.classList.add('dracula-mode');
        }

        // Toggle function for Dracula mode
        function toggleDraculaMode() {
            document.body.classList.toggle('dracula-mode');
            if (document.body.classList.contains('dracula-mode')) {
                localStorage.setItem('theme-mode', 'dracula');
            } else {
                localStorage.setItem('theme-mode', 'default');
            }
        }
    </script>


</body>

</html>