<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Bits&Bytes</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/side-nav-bar.css') }}" rel="stylesheet"/>

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

    <link href="{{ asset('css/manage-user.css') }}" rel="stylesheet"/>
</head>
<body>
@include('includes.sidebar')
@include('includes.page-wrapper')

<!-- Page content-->
<div class="container-fluid p-2">
    <h3 class="page-title">SYSTEM USERS</h3>
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
    <div class="row row-add-user d-flex flex-row-reverse">
    </div>
    <div class="row p-3">
        <table id="example" class="table table-hover border p-2" style="width:100%">
            <thead class="">
            <tr>
                <th>Name</th>
                <th>Use Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                    <td>
                        @if($user->user_role == 1)
                            <p>Admin</p>
                        @elseif($user->user_role == 2)
                            <p>Manager</p>
                        @elseif($user->user_role == 3)
                            <p>Employee</p>
                        @endif
                    </td>
                    <td>
                        @if ($user->status === 'Active')
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>

                        <a href="view-user/{{ $user->id }}" class="btn btn-upd-user"><i class="bi bi-eye-fill"></i></a>


                        @if ($user->status === 'Active')
                            <button type="button" class="btn btn-upd-user" data-bs-toggle="modal"
                                    data-bs-target="#enable-category-modal{{ $user->id }}"><i
                                    class="bi bi-check-circle-fill"></i></button>
                        @else
                            <button type="button" class="btn btn-upd-user" data-bs-toggle="modal"
                                    data-bs-target="#enable-category-modal{{ $user->id }}"><i
                                    class="bi bi-x-circle-fill"></i></button>
                        @endif

                        <a href="view-sched/{{ $user->id }}" class="btn btn-upd-user" ><i class="bi bi-calendar"></i></a>

                    </td>


                </tr>

            @endforeach


        </table>
    </div>
</div>
</div>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal" id="category">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-list-ol">&nbsp;</i>Add New USer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <form id="registration-form" method="POST" action="/admin/store-user">
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
                            <select type="text" name="user_role" class="form-select">
                                <option value="3">Employee</option>
                                <option value="2">Manager</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="email" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name"
                                   required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>

                        <div class="mb-3">
                            <h5><b>Gender</h5>
                        </div>
                        <div class="mb-3">
                            <select type="text" name="gender" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <h5><b>Contact</h5>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="contactfield" name="mobile"
                                   placeholder="Contact (09)" onkeyup=" return validatephone(this.value); " required>
                        </div>

                        <div class="mb-3">
                            <p style="font-weight: bold; font-size: 10px;">Update Password?</p>
                            <input type="password" class="form-control" id="password" placeholder="Enter New Password"
                                   name="password" required>
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" id="confirm-password"
                                   placeholder="Confirm Password" name="password_confirmation" required>
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


@foreach($users as $user)
    <div class="modal" id="enable-category-modal{{ $user->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div>
                        <h5 class="d-flex justify-content-center">Are you sure you want
                            to {{ $user->status === 'Active' ? 'Disable' : 'Enable' }} this user?</h5>
                    </div>
                </div>
                <!-- Modal Footer (optional) -->
                <form method="post" action="/manager/user-status">
                    @csrf
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <input type="hidden" name="new_status"
                               value="{{ $user->status === 'Active' ? 'Inactive' : 'Active' }}">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-dark" style="width: 20%;">Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 40%;">No
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach



<!-- UPDATE CATEGORY MODAL -->


<!-- VALIDATE CONTACT NO. -->
<script>
    function validatephone(phone) {
        phone = phone.replace(/[^0-9]/g, '');
        $("#contactfield").val(phone);
        if (phone == '' || !phone.match(/^0[0-9]{10}$/)) {
            $("#contactfield").css({'background': '#FFEDEF', 'border': 'solid 1px red'});

            return false;
        } else {
            $("#contactfield").css({'background': '#99FF99', 'border': 'solid 1px #99FF99'});
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

<script>
    function openModal() {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    }
</script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
