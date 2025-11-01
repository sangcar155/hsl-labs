<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background: #f8f9fa;
        }
        .top-navbar {
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center py-3">Provider Dashboard</h4>
        <a href="{{ route('dashboard.home') }}">Dashboard Home</a>
        <a href="{{ route('dashboard.orders') }}">Orders</a>

    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="top-navbar">
            <div class="ms-auto">
                <span>Welcome, Provider</span>
            </div>
        </div>

        <!-- Page content -->
        <div class="content mt-4">
            @yield('content')
        </div>
    </div>

</body>
</html>
