<!DOCTYPE html>
<html>
<head>
    <title>index</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Latest Bootstrap 5 JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">

</head>
<body class="login-body">



@include('includes.login_navbar')

<div class="container con-css">
    <div class="row">
        <div class="col p-4" style="">
            <h3 class="login-title d-flex justify-content-center mx-2">BITS&BYTES</h3>
            <img src="{{ asset('assets/dashboard.svg') }}" alt="Cannot Load Image" style="width: 100%;">
        </div>
        <div class="col d-flex justify-content-center p-5" style="">
            <div class="card p-3" style="width: 32rem;">
                <div class="col">
                    <h4 class="text-center">Login</h4>
                    <form action="/login"  method="post" >
                        @csrf

                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="email" class="form-control" id="username" placeholder="Enter your username" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-dark login-btn">Login</button>
                        <div class="soc-med d-flex justify-content-center">
                            <a href="https://www.facebook.com/bitsnbytesitsolution" class=""><i class="bi bi-facebook"></i></a>
                            <a href="https://www.facebook.com/messages/t/100154238969704" class="mx-1"><i class="bi bi-messenger"></i></a>
                            <a href="bitsandbytes.itsolution@gmail.com" target="_blank"><i class="bi bi-envelope-fill"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
