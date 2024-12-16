<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Sanctum Auth</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 15px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .navbar {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laravel Sanctum</a>
        </div>
        <a href="/stories" class="nav-link">stories</a>
        <a href="/most-writer" class="nav-link ms-3">Leaderboard</a>
            
        <!-- If user is logged in, show logout button -->
        @if(auth()->check())
            <button id="logout-btn" class="btn btn-danger me-5">Logout</button>
        @else
            <a id="logout-btn" href="/login" class="btn btn-danger me-5">Login</a>
            <a id="logout-btn" href="/register" class="btn btn-danger me-5">Register</a>
        @endif
    </nav>

    <div class="main-content container-fluid p-0 ">
        @if(auth()->check())

        <div class="sidebar">
            <h4>Dashboard</h4>
            <a href="/stories">stories</a>
            <a href="/stories-auther">Stories Auther</a>
            <a href="/leaderboard">Leaderboard</a>
            <a href="#">Messages</a>
        </div>
        @endif
        

        <!-- Main Content -->
        <div class="content-area flex-grow-1 p-3">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
    $('#logout-btn').click(function () {
        const token = localStorage.getItem('token');
        
        // Check if the token exists before making the request
        if (!token) {
            console.log('No token found, already logged out');
            // You can redirect to login here if needed
            window.location.href = '/login';
            return;
        }

        $.ajax({
            url: '/api/logout',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function (response) {
                // Remove token from localStorage upon successful logout
                localStorage.removeItem('token');
                
                // Check if the server has responded with a successful logout message
                if (response.message === 'Logged out successfully') {
                    console.log('Logged out successfully');
                    // Optionally redirect to login page
                    window.location.href = '/login';
                } else {
                    console.log('Logout failed or token already invalidated');
                    // Handle failure if needed (e.g., show a message or stay on the current page)
                }
            },
            error: function (xhr, status, error) {
                // Handle the error scenario
                console.log('Error during logout:', error);
                // Optionally redirect to login if the request fails
                window.location.href = '/login';
            }
        });
    });
});

    </script>
</body>
</html>
