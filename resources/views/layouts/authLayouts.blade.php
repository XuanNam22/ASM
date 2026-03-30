<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Xác thực hệ thống</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/light/plugins.css') }} " rel="stylesheet" type="text/css" />
    
    <style>
        body { background: #f8f8f8; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .auth-container { width: 100%; max-width: 400px; padding: 15px; }
    </style>
</head>
<body class="form">
    
    <div class="auth-container">
        @yield('content')
    </div>

    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
</body>
</html>