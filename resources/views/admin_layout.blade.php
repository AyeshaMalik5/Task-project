<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <style>
        body {
            margin: 0;
        }
        .navbar {
            background-color: #255061 !important;
            color: white;
        }
        .main-container {
            display: flex;
            height: calc(100vh - 56px);
        }
        .left-bar {
            width: 250px;
            background-color: #e0f7ff;
            padding: 20px;
            border-right: 1px solid #dee2e6;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .role {
            padding: 10px;
            background-color: #d1ecf1;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
        }
        .admin-role {
            position: absolute;
            left: 20px;
            top: 18px;
            font-size: 18px;
            font-weight: bold;
            color: red;
        }
        .admin-info {
            font-size: 22px;
            font-weight: bold;
            color: white;
            text-align: center;
        }
        .top-actions {
            position: absolute;
            right: 20px;
            top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
        }
          .logout-form {
            margin:0%;
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
         /* My Custom Notification Colors */
        .notification-unread {
            background-color: #fff3cd !important; /* light yellow */
            color: #212529 !important;
            font-weight: bold;
        }
        .notification-read {
            background-color: #f8f9fa !important; /* light grey */
            color: #6c757d !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light position-relative" style="height: 60px;">
    <div class="container-fluid">

        <div class="admin-role">
            {{ Auth::user()->role }}
        </div>

        <div class="admin-info mx-auto">
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
    </div>
        <form class="logout-form" method="POST" action="{{ route('logout') }}" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

    </div>
</nav>

<div class="main-container">
    <div class="left-bar"> 
        <h5>Roles</h5>
        <div class="role"><a href="{{ route('admin') }}" class="text-decoration-none text-dark">Admin</a></div>
        <div class="role"><a href="{{ route('employee') }}" class="text-decoration-none text-dark">Employee</a></div>
        <div class="role"><a href="{{ route('tasklist') }}" class="text-decoration-none text-dark">Task list</a></div>
     <div class="role"><a href="{{ route('register') }}" class="text-decoration-none text-dark">Register user</a></div>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
