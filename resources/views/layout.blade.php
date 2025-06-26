<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #255061;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-weight: bold;
            font-size: 20px;
        }
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100vh - 60px);
            background-color: #e0f7ff;
            padding: 20px;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
        }

        .content {
            margin-top: 60px;
            margin-left: 250px;
            padding: 20px;
        }

        .admin-role {
            font-size: 16px;
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
        }

        .role {
            padding: 10px;
            background-color: #d1ecf1;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
        }

        .notification-unread {
            background-color: #fff3cd !important;
            color: #212529 !important;
            font-weight: bold;
        }

        .notification-read {
            background-color: #f8f9fa !important;
            color: #6c757d !important;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-form {
            margin: -10%;
        }

        .bell-button {
            width: 36px;
            height: 36px;
            background-color: yellow;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .bell-button i {
            font-size: 1.2rem;
            color: black;
        }

        #notification-count {
            font-size: 0.6rem;
            padding: 3px 6px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div></div>

    <div class="navbar-center">
        {{ Auth::user()->name }}
    </div>

    <div class="top-right">
        <!-- Notification Bell -->
        <div class="dropdown position-relative">
            <button class="bell-button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell"></i>
                @php
                    $unreadCount = auth()->user()->unreadNotifications->count();
                @endphp
                @if ($unreadCount > 0)
                    <span id="notification-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 300px; max-height:400px; overflow-y:auto;">
                <li><h6 class="dropdown-header">Unread Notifications</h6></li>
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <li>
                        <a class="dropdown-item notification-unread" href="{{ route('notifications.markAsRead', $notification->id) }}">
                            {{ $notification->data['message'] ?? 'New Notification' }}
                        </a>
                    </li>
                @empty
                    <li><span class="dropdown-item text-muted">No new notifications</span></li>
                @endforelse

                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header">Read Notifications</h6></li>
                @forelse (auth()->user()->readNotifications as $notification)
                    <li>
                        <a class="dropdown-item notification-read" href="#">
                            {{ $notification->data['message'] ?? 'Notification' }}
                        </a>
                    </li>
                @empty
                    <li><span class="dropdown-item text-muted">No read notifications</span></li>
                @endforelse
            </ul>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</nav>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="admin-role">
        {{ Auth::user()->role }}
    </div>

    <h5>Roles</h5>
    <div class="role">
        <a href="#" class="text-decoration-none text-dark">Profile</a>
    </div>
    <div class="role">
        <a href="{{ route('task_list') }}" class="text-decoration-none text-dark">Task List</a>
    </div>
    <div class="role">
        <a href="{{ route('task') }}" class="text-decoration-none text-dark">Task</a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    @yield('content')
</div>
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>

</body>
</html>
