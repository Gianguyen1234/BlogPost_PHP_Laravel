<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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
                <a href="#managePostsDropdown" class="list-group-item list-group-item-action text-light" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="bi bi-file-post me-2"></i> Manage Posts
                    <i class="bi bi-chevron-down float-end"></i>
                </a>
                <div class="collapse" id="managePostsDropdown">
                    <div class="list-group">
                        <a href="{{ route('admin.categories.index' }}" class="list-group-item list-group-item-action text-light">View All Categories</a>
                        <a href="{{ route('admin.categories.create') }}" class="list-group-item list-group-item-action text-light">Create New Post</a>
                    </div>
                </div>
                <a href="#" class="list-group-item list-group-item-action text-light">
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
                    <h1 class="ms-3">Dashboard</h1>
                </div>
            </header>
            <div class="container-fluid p-4">
                
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap and Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

</body>

</html>