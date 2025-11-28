<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .wrapper { display: flex; min-height: 100vh; }
        .content-wrapper { flex-grow: 1; padding: 20px; background: #f8fafc; }

        /* Styles dari sidebar.blade.php */
        .sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
        }
        .sidebar .nav-link {
            color: #cbd5e1;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff !important;
            transform: translateX(5px);
        }
        .sidebar .active-link {
            background: linear-gradient(90deg, #0d6efd, #6366f1);
            color: #fff !important;
            box-shadow: 0 0 12px rgba(13, 110, 253, 0.6);
        }
        .icon-circle {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #9ca3af;
            transition: all 0.3s ease;
        }
        .nav-link:hover .icon-circle,
        .active-link .icon-circle {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
        }
    </style>
</head>
<body class="bg-light">

    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>