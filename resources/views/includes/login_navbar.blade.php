<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/nav.css') }}">

    <title>Responsive Navbar</title>

    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('assets/logo.png') }}" alt="logo" style="width: 8%;">&nbsp;&nbsp;Bits & Bytes POS & Inventory System</a>
    </div>
</nav>

<!-- Link to Bootstrap JS and Popper.js (required for Bootstrap features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
