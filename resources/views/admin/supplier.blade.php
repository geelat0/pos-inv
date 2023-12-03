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
                <div class="container-fluid p-2">
                <h3 class="page-title">SUPPLIERS</h3>
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
                    @if($errors->has('supplier_name'))
                        <div class="alert alert-danger">
                            <p>{{ $errors->first('supplier_name') }}</p>
                        </div>
                    @endif

                    <div class="row row-add-user d-flex flex-row-reverse">
                        <button type="button" class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#supplier">New Supplier</button>
                    </div>
                    <div class="row p-3">
                        <table id="example" class="table table-hover border p-2" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>Suppliers</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers as $item )
                                <tr>
                                    <td>{{$item->supplier_name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->contact_no}}</td>
                                    <td>
                                        @if ($item->status === 'Active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#upd-supplier{{ $item->id }}"><i class="bi bi-arrow-repeat"></i></button>

                                        @if ($item->status === 'Active')
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#enable-supplier-modal{{ $item->id }}"><i class="bi bi-check-circle-fill"></i></button>
                                        @else
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#enable-supplier-modal{{ $item->id }}"><i class="bi bi-x-circle-fill"></i></button>
                                        @endif
                                       
                                    </td>
                                </tr>
                             @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- ADD SUPPLIER MODAL -->

        <div class="modal" id="supplier">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-truck" style="font-size: 24px;">&nbsp;</i>Add New Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div>
                    <form id="new-category" action="/admin/store-supplier" method="post">
                    @csrf
                    @method('post')
                        <div class="mb-3">
                            <input type="text" name="supplier_name" class="form-control" id="supplier_name" placeholder="Supplier Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="texr" name="contact_no" class="form-control" id="contact_no" placeholder="Contact Number" required>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer (optional) -->
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Add</button>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <!-- UPDATE SUPPLIER MODAL -->
        @foreach ($suppliers as $item )
            <div class="modal" id="upd-supplier{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-truck" style="font-size: 24px;">&nbsp;</i>Update Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div>
                        <form id="new-category" method="post" action="/admin/update_supplier">
                        @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="mb-3">
                                <input type="text" name="supplier_name" value="{{ $item->supplier_name }}" class="form-control" id="" placeholder="Supplier Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" value="{{ $item->email }}" class="form-control" id="" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="contact_no" value="{{ $item->contact_no }}" class="form-control" id="" placeholder="Contact" required>
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
        @endforeach

        <!-- ENABLE SUPPLIER -->
        @foreach ($suppliers as $item )
            <div class="modal" id="enable-supplier-modal{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div>
                                <h5 class="d-flex justify-content-center">Are you sure you want to {{ $item->status === 'Active' ? 'Disable' : 'Enable' }} this Supplier?</h5>
                            </div>
                        </div>
                        <!-- Modal Footer (optional) -->
                        <form method="post" action="/admin/supplier-status">
                            @csrf
                                <div class="modal-footer d-flex justify-content-center border-0">
                                    <input type="hidden" name="new_status" value="{{ $item->status === 'Active' ? 'Inactive' : 'Active' }}">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-dark" style="width: 20%;">Yes</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 40%;">No</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
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
