<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 11 CRUD Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>
    <div class="container">
        <div class="page-header text-center">
            <h3><i class="fas fa-cubes me-2"></i>Laravel 11 CRUD Application</h3>
        </div>
        
        @yield('content')
        
        <footer class="footer text-center">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        Return to Website: <a href="https://www.usjr.edu.ph/"><strong>University of San Jose - Recoletos</strong></a>
                    </p>
                </div>
 
            </div>
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
