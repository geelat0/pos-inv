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
    <link href="{{ asset('css/side-nav-bar.css') }}" rel="stylesheet" />

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

    <link href="{{ asset('css/manage-user.css') }}" rel="stylesheet" />
</head>
<body>
@include('includes.sidebar')
@include('includes.page-wrapper')



<!-- Page content-->
<div class="container-fluid p-5">


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


    <div class="row pb-3">
        <div class="col-md-12 d-flex justify-content-center" style="background-color;">
            <div class="card d-flex -justify-content-center card-view-profile" style="width: 32rem;">
                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-md-6">
                            <img src="data:image/png;base64,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" class="card-img-top" alt="Sample Image">
                        </div>
                        <div class="col-md-6 card-user-profile-body">
                            <h5 class=""><!-- <b>Account Type:&nbsp;</b> -->

                                @if($user->user_role == 1)
                                    Admin
                                @elseif($user->user_role == 2)
                                    Manager
                                @elseif($user->user_role == 3)
                                    Employee
                                @endif
                            </h5>
                            <h5 class="card-title mb-4" style="font-size: 16px;"></h5>
                            <h5 class=""><b>Gender:&nbsp;</b>{{ $user->gender }}</h5>
                            <h5 class=""><b>Contact No.:&nbsp;</b> {{ $user->mobile }}</h5>
                            <h5 class=""><b>Username:&nbsp;</b> {{ $user->email }}</h5>
                            <h5 class="" style="color: #12c300;">
                                @if ($user->status === 'Active')
                                    <span>Active Account</span>
                                @else
                                    <span>Inactive</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-update-profile" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#update-user-profile">Update Profile</button>
                        </div>


                        <div class="col-md-12 mt-3">
                            <button class="btn btn-secondary" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#change-password">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3">
        <table id="example" class="table table-hover border p-2" style="width:100%">
            <thead class="">
            <tr>
                <th>Date</th>
                <th>Day</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>


            @foreach($logins as $login)
                <tr>

                    <td>{{ \Carbon\Carbon::parse($login->date_time_in)->formatLocalized(' %d %B %Y %H:%M:%S') }}</td>

                    <td>{{ \Carbon\Carbon::parse($login->date_time_in)->formatLocalized(' %A') }}</td>

                    @if($login->status == 'Logged In')
                        <td><span class="badge badge-success">{{ $login->status }}</span></td>
                       @else
                        <td><span class="badge badge-danger">{{ $login->status }}</span></td>

                    @endif


                </tr>
            @endforeach


        </table>
    </div>
</div>


<!-- UPDATE USER PROFILE MODAL -->



<div class="modal" id="update-user-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-list-ol">&nbsp;</i>Add New USer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <form id="registration-form" method ="POST" action="/admin/update-user/{{$user->id}}">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div>
                        <!-- <div class="alert alert-danger" role="alert">
                            PASSWORD DO NOT MATCH!
                        </div> -->
                        <div class="mb-3">
                            <h5><b>User Type</h5>
                        </div>
                        <div class="mb-3">
                            <select type="text"  name="user_role" class="form-select">

                                <option value="3" @if($user->user_role == '3') selected @endif>Employee</option>
                                <option value="2" @if($user->user_role == '2') selected @endif>Manager</option>

                            </select>
                        </div>



                        <div class="mb-3">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name"  value="{{  $user->first_name}}" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" value="{{  $user->middle_name}}" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{  $user->last_name }}" required>
                        </div>

                        <div class="mb-3">
                            <h5><b>Gender</h5>
                        </div>


                        <div class="mb-3">
                            <select type="text" name="gender" class="form-select">
                                <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
                                <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <h5><b>Contact</h5>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="contactfield" name="mobile"  value="{{  $user->mobile }}" placeholder="Contact (09)" onkeyup=" return validatephone(this.value); " required>
                        </div>

{{--                        <div class="mb-3">--}}
{{--                            <p style="font-weight: bold; font-size: 10px;">Update Password?</p>--}}
{{--                            <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-2">--}}
{{--                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" name="password_confirmation" required>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <!-- Modal Footer (optional) -->
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal" id="change-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-list-ol">&nbsp;</i>Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <form id="registration-form" method ="POST" action="/admin/update-user-password/{{$user->id}}">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div>

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
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- MODAL SCRIPT -->
<script>
    function openModal() {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    }
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
