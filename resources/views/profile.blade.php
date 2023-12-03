
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bits&Bytes</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/side-nav-bar.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript (and Popper.js if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">




</head>
<body>

    <!-- Page content-->
<div class="container-fluid p-5">



    <div class="row">

        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>




        <div class="col-md-12 d-flex justify-content-start  align-items-center ">
            <a href="/{{ Auth::user()->user_role == 1 ? 'admin' : (Auth::user()->user_role == 2 ? 'manager' : 'employee') }}"  class="btn"><i class="bi bi-arrow-left-circle-fill" style="font-size: 24px; color:#2b3499;">&nbsp;</i>Return</a>
        </div>

        <div class="col-md-12 d-flex justify-content-center">
            <img class="profile-img" src="{{ asset('assets/profile.png') }}" alt="dsad" style="width: 20%;">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12 d-flex justify-content-center">
            <h4>{{  $user->first_name   }} <span class="me-3 ms-2">{{  $user->last_name   }}</span> </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <h6>
                @if($user->user_role == 1)
                    <p>Admin</p>
                @elseif($user->user_role == 2)
                    <p>Manager</p>
                @elseif($user->user_role == 3)
                    <p>Employee</p>
                @endif</h6>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="card rounded card-profile" style="width: 50%;">
                <div class="card-body">
                    <label for="" style="font-weight: bold;">Gender</label>
                    <h6>{{  $user->gender   }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="card rounded card-profile" style="width: 50%;">
                <div class="card-body">
                    <label for="" style="font-weight: bold;">Contact Number</label>
                    <h6>{{  $user->mobile   }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 d-flex justify-content-end">
            <div class="card rounded border-0 card-profile mt-2" style="width: 49%; background-color: #1d2365;">
                <div class="card-body">
                    <label for="" style="font-weight: bold; color: #ffd099;">Email/Username</label>
                    <h6 style="color: #ffd099;">{{  $user->email   }}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-start">
            <div class="card rounded card-profile mt-2" style="width: 49%;">
                <div class="card-body">
                    <label for="" style="font-weight: bold;" >Change Password</label>
                    <button class="btn btn-primary" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#change-pass">Change Password</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            <button class="btn btn-primary upd-btn-profile" style="width: 50%;" data-bs-toggle="modal" data-bs-target="#upd-profile">Update Profile</button>
        </div>
    </div>
</div>


<!-- UPDATE PASSWORDL -->

<div class="modal" id="change-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <form  id="" method="post" action="/change-password/{{$user->id}}">
                        @csrf
                        <!-- <div class="alert alert-danger" role="alert">
                            PASSWORD DO NOT MATCH!
                        </div> -->
                        <div class="mb-3">
                            <p style="font-weight: bold; font-size: 10px;">Update Password?</p>
                            <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password" required>
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" name="password_confirmation" required>
                        </div>
                </div>
            </div>
            <!-- Modal Footer (optional) -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE PASSWORDL -->

<div class="modal" id="upd-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <form id="registration-form" method="post" action="/profile-update">
                        <!-- <div class="alert alert-danger" role="alert">
                            PASSWORD DO NOT MATCH!
                        </div> -->
                        @csrf
                        <input type="hidden" name="id" class="form-control" id="id" placeholder="First Name" value="{{ $user->id }}" required>

                        <div class="mb-3">
                               <h6>
                            @if($user->user_role == 1)
                                <p>Admin</p>
                            @elseif($user->user_role == 2)
                                <p>Manager</p>
                            @elseif($user->user_role == 3)
                                <p>Employee</p>
                                @endif</h6>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="first_name" class="form-control" id="name" placeholder="First Name" value="{{ $user->first_name }}" required>
                        </div>
                        <div class="mb-3">
                            <input type="text"  name="middle_name" class="form-control" id="name" placeholder="Middle Name" value="{{ $user->middle_name }}" required>
                        </div>
                        <div class="mb-3">
                            <input type="text"  name="last_name" class="form-control" id="name" placeholder="Last Name"  value="{{ $user->last_name }}" required>
                        </div>

                        <label for="male">
                            <input type="radio" name="gender" id="male" value="Male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                            Male
                        </label>

                        <label for="female">
                            <input type="radio" name="gender" id="female" value="Female" {{ $user->gender == 'female' ? 'checked' : '' }}>
                            Female
                        </label>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="contactfield" name="mobile"  value="{{ $user->mobile }}" placeholder="Contact (09)" onkeyup=" return validatephone(this.value); " required>
                        </div>

                </div>
            </div>
            <!-- Modal Footer (optional) -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- VALIDATE CONTACT NO. -->
<script>
    function validatephone(phone)
    {
        phone = phone.replace(/[^0-9]/g,'');
        $("#contactfield").val(phone);
        if( phone == '' || !phone.match(/^0[0-9]{10}$/) )
        {
            $("#contactfield").css({'background':'#FFEDEF' , 'border':'solid 1px red'});

            return false;
        }
        else
        {
            $("#contactfield").css({'background':'#99FF99' , 'border':'solid 1px #99FF99'});
            return true;
        }
    }
</script>

<!-- VALIDATE PASSWORD -->
<script>
    document.getElementById('registration-form').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            alert("PASSWORD DO NOT MATCH!. Please try again.");
            e.preventDefault(); // Prevent the form from being submitted
        }
    });
</script>


<!-- DATATABLES -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
