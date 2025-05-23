    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzWire News - @yield('title', 'Home')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Navbar Styles */
        .navbar {
            background-color: #212121;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: bold;
            color: white !important;
            padding-left: 15px;
        }

        .search-box {
            background-color: #e0e0e0;
            border-radius: 4px;
            width: 400px;
            max-width: 450px;
        }

        /* Other styles from your paste-2.txt */
        /* - Copy all CSS styles from paste-2.txt here - */
    </style>
    @yield('styles')
</head>
<body>
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Include Categories Component -->
    @include('components.categories')
    
    <!-- Main Content -->
    <div class="content-container">
        @yield('content')
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>