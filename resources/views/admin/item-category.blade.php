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
                <h3 class="page-title">ITEM CATEGORY</h3>
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
                    @if($errors->has('category_name'))
                        <div class="alert alert-danger">
                            <p>{{ $errors->first('category_name') }}</p>
                        </div>
                    @endif
                    <div class="row row-add-user d-flex flex-row-reverse">
                        <button type="button" class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#category">New Category</button>
                    </div>
                    <div class="row p-3">
                        <table id="example" class="table table-hover border p-2" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>Categories</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $item )
                                <tr>
                                    <td>{{$item->category_name}}</td>
                                    <td>
                                        @if ($item->status === 'Active')
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#upd-category{{ $item->id }}"><i class="bi bi-arrow-repeat"></i></button>

                                        @if ($item->status === 'Active')
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#enable-category-modal{{ $item->id }}"><i class="bi bi-check-circle-fill"></i></button>
                                        @else
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#enable-category-modal{{ $item->id }}"><i class="bi bi-x-circle-fill"></i></button>
                                        @endif
                                       
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
                    <h5 class="modal-title"><i class="bi bi-list-ol">&nbsp;</i>Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <form id="new-category" method ="POST" action="/admin/store-category">
                @csrf
                @method('post')
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <input type="text" name = "category_name" class="form-control" id="category_name" placeholder="Category Name" required>
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

        <!-- UPDATE CATEGORY MODAL -->
        @foreach ($categories as $item )
            <div class="modal" id="upd-category{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-list-ol" style="font-size: 24px;">&nbsp;</i>Update Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <form id="new-category" method="post" action="/admin/update_category">
                    @csrf
                        <div class="modal-body">
                            <div>
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="text" name="category_name" value="{{ $item->category_name }}" class="form-control" id="category_name" placeholder="Category Name" required>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer (optional) -->
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Update</button>
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- ENABLE CATEGORY -->
        @foreach ($categories as $item )
            <div class="modal" id="enable-category-modal{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                            <div class="modal-body">
                                <div>
                                    <h5 class="d-flex justify-content-center">Are you sure you want to {{ $item->status === 'Active' ? 'Disable' : 'Enable' }} this Category?</h5>
                                </div>
                            </div>
                            <!-- Modal Footer (optional) -->
                            <form method="post" action="/admin/category-status">
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
