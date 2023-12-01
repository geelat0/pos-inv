<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Responsive Navbar with Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link href="css/nav.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 0; /* Adjust according to your navbar height */
        }

        @media (min-width: 768px) {
            body {
                padding-top: 0;
            }
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <img class="nav-logo" src="assets/logo.png" alt="">&nbsp;
    <a class="navbar-brand" href="#">Bits & Bytes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" id="navbar">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}/employee">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}/employee/report">Sales Report</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown profile">
                <a class="employee-profile" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 30px;"><i class="bi bi-person-circle" style="font-size: 24px;">&nbsp;</i>Employee Name</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/') }}/logout" style="color: #ff0000;"><i class="bi bi-box-arrow-left" style="font-size: 15px;">&nbsp;</i>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


<script>
    // Get the current page URL
    var currentUrl = window.location.href;

    // Get all sidebar links
    var sidebarLinks = document.querySelectorAll('#navbar a');

    // Loop through each link and check if the href matches the current URL
    sidebarLinks.forEach(function(link) {
        if (link.href === currentUrl) {
            link.classList.add('active');
        }
    });
</script>

<!-- Content goes here -->

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
