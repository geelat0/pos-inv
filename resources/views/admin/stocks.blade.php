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

        <!-- ADDED CSS -->
        <link href="{{ asset('css/manage-user.css') }}" rel="stylesheet" />
    </head>
    <body>
        @include('includes.sidebar')
        @include('includes.page-wrapper')

        <!-- Page content-->
                <div class="container-fluid">
                <h3 class="page-title">ITEM STOCKS</h3>

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

                     <!-- ADD ITEM -->
                    <div class="card m-4">
                        <div class="card-body">
                            <h4 style="font-weight: bold; font-size: 24px; color: #ff6c22;">Adding New Item</h4>
                            <form action="/admin/add-stocks" method="post">
                                @csrf
                                @method('post')
                                <div class="row mt-3 add-new-item-form">
                                    <div class="col-sm-6 nopadding add-new-item-form-select">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select class="form-control" id="category_id " name="category_id[]" >
                                                    <option value="">Select Category</option>
                                                @foreach ($categories as $item )
                                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 nopadding add-new-item-form-select">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select class="form-control" id="supplier_id" name="supplier_id[]">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $item )
                                                    <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row add-new-item-form">
                                    <div class="col-sm-6 nopadding add-new-item-field">
                                        <div class="form-group">
                                        <label for="">Item Name</label>
                                        <input type="text" class="form-control" id="name" name="name[]" value="" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 nopadding add-new-item-field">
                                        <div class="form-group">
                                        <label for="">Order batch #</label>
                                        <input type="text" class="form-control" id="batch" name="batch[]" value="{{ $lastId }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row border-bottom add-new-item-form">
                                    <div class="col-sm-3 nopadding add-new-item-field">
                                        <div class="form-group">
                                        <label for="">Buying Price</label>
                                        <input type="text" class="form-control" id="supplier_price" name="supplier_price[]" value="" placeholder="Enter Buying Price">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 nopadding add-new-item-field">
                                        <div class="form-group">
                                        <label for="">Selling Price</label>
                                        <input type="text" class="form-control" id="selling_price" name="selling_price[]" value="" placeholder="Enter Selling Price">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 nopadding add-new-item-field mb-3">
                                        <div class="form-group">
                                        <label for="">Replenishment Threshold</label>
                                        <input type="number" class="form-control" id="replenish" name="replenish[]" value="" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 nopadding add-new-item-field mb-3">
                                        <div class="form-group">
                                        <label for="">Item Quantity</label>
                                        <input type="number" class="form-control" id="no_of stocks" name="no_of stocks[]" value="" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div id="add_category">
                                </div>

                                <div class="input-group-btn">
                                    <div class="mt-3">
                                        <div class="col-sm d-flex justify-content-center mb-3">
                                            <button class="btn btn-primary" type="button"  onclick="add_category();" style="width:100%;">New Form</button>
                                        </div>
                                        <div class="col-sm d-flex justify-content-center">
                                            <button class="btn btn-primary" type="Submit" style="width: 100%;">Submit</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </form>

                        </div>
                    </div>

                    <!-- BUTTON FOR ITEM RESTOCK -->
                    <div class="row row-add-user d-flex justify-content-end flex-row">
                        <!-- <button type="button" class="btn btn-stock" data-bs-toggle="modal" data-bs-target="#new-item">New Item</button> -->
                        <button type="button" class="btn btn-stock" data-bs-toggle="modal" data-bs-target="#restock">Restock</button>
                    </div>

                    <!-- DISPLAY ITEM -->
                    <div class="row p-3">
                        <table id="example" class="table table-hover border p-2" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Stocks</th>
                                    <th>Replenishment Threshold</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->category_name }}</td>
                                    <td>{{ $item->supplier->supplier_name }}</td>
                                    <td>{{ $item->supplier_price}}</td>
                                    <td>{{ $item->selling_price}}</td>
                                    <td>{{ $item->no_of_stocks}}</td>
                                    <td>
                                        @if ($item->no_of_stocks <= $item->replenish)
                                            <span class="badge badge-danger">Need Restocking</span>
                                        @else
                                            <span class="badge badge-success">Item Full</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'Active')
                                            <span class="badge badge-success">Item Enabled</span>
                                        @else
                                            <span class="badge badge-danger">Item Disabled</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#update-item{{ $item->id }}"><i class="bi bi-arrow-repeat"></i></button>
                                        @if ($item->status === 'Active')
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#enable-stock-modal{{ $item->id }}"><i class="bi bi-check-circle-fill"></i></button>
                                        @else
                                        <button type="button" class="btn btn-upd-user" data-bs-toggle="modal" data-bs-target="#enable-stock-modal{{ $item->id }}"><i class="bi bi-x-circle-fill"></i></button>
                                        @endif
                                        <!-- UPDATED TO ICON -->
                                        <a  class="btn btn-upd-user" data-toggle="tooltip" data-placement="top" title="Download QR Code" href="{{ url('/generate',$item->id) }}" ><i class="bi bi-box-arrow-down" style="color: #12c300;"></i></a> 

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

        <!-- RESTOCK ITEM -->

        <div class="modal" id="restock">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-truck" style="font-size: 24px;">&nbsp;</i>Restock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div>
                    <form id="new-category" method="post" action='/admin/restocks'>
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <select class="selectpicker form-control" id="category" name="category_id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                <option selected="true" disabled="disabled">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="selectpicker form-control"  id="supplier" name="supplier_id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                <option selected="true" disabled="disabled">Select Supplier</option>
                                @foreach ($suppliers as $item )
                                    <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="selectpicker form-control" id="item" name="id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                <option selected="true" disabled="disabled">Select Item</option>
                                @foreach ($ItemStocks as $item)
                                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Batch Order #</label>
                            <input type="text" class="form-control" id="batch" value="{{ $lastId }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Item Quantity</label>
                            <input type="number" class="form-control" name= 'qty' id="" placeholder="" required>
                        </div>
                        </div>
                        </div>
                        <!-- Modal Footer (optional) -->
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Restock Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- UPDATE ITEM -->
        @foreach($items as $item)
            <div class="modal" id="update-item{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-truck" style="font-size: 24px;">&nbsp;</i>Update Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div>
                        <form id="new-category" action="/admin/update_item" method="post">
                        @csrf
                        @method('post')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="mb-3">
                                <label for="">Item Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" placeholder="Update name">
                            </div>
                            <div class="mb-3">
                                <label for="">Item Quantity</label>
                                <input type="number" class="form-control" id="" value="{{$item->no_of_stocks}}"  readonly>
                            </div>
                            <div class="mb-3">
                                <select class="selectpicker form-control" id= "category_id" name = "category_id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                        <option selected="true" disabled="disabled">Select Category</option>
                                    <@foreach ($categories as $item )
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="selectpicker form-control" id= "supplier_id" name= "supplier_id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                    <option selected="true" disabled="disabled">Select Supplier</option>
                                    @foreach ($suppliers as $item )
                                        <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="supplier_price" name="supplier_price"  placeholder="Update Buying Price">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="supplier_price"  name="selling_price" placeholder="Update Selling Price">
                            </div>
                            <div class="mb-3">
                                <label for="">Replenishment Threshold</label>
                                <input type="number" class="form-control" id="replenish" name="replenish" placeholder="Update replenishment threshold">
                            </div>
                        </div>
                    </div>
                        <!-- Modal Footer (optional) -->
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Item</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- ENABLE STOCK -->
        @foreach($items as $item)
            <div class="modal" id="enable-stock-modal{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div>
                                <h5 class="d-flex justify-content-center">Are you sure you want to {{ $item->status === 'Active' ? 'Disable' : 'Enable' }} this Stock?</h5>
                            </div>
                        </div>
                        <!-- Modal Footer (optional) -->
                        <form method="post" action="/admin/stock-status">
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

    <!-- ADD NEW ITEM FORM -->
        <script>
            var room = 1;
            function add_category() {

                room++;
                var objTo = document.getElementById('add_category')
                var divtest = document.createElement("div");
                divtest.setAttribute("class", "form-group removeclass"+room);
                var rdiv = 'removeclass'+room;
                divtest.innerHTML = ' <h4 class="mt-3" style="font-weight: bold; font-size: 24px; color: #ff6c22;">Adding New Item</h4> <div class="row mt-3 add-new-item-form"> <div class="col-sm-6 nopadding add-new-item-form-select"> <div class="form-group"> <div class="input-group"> <select class="form-control" id="category_id" name="category_id[]"> <option value="">Select Category</option> @foreach ($categories as $item ) <option value="{{ $item->id }}">{{ $item->category_name }}</option> @endforeach </select> </div> </div> </div> <div class="col-sm-6 nopadding add-new-item-form-select"> <div class="form-group"> <div class="input-group"> <select class="form-control" id="supplier_id" name="supplier_id[]"> <option value="">Select Supplier</option> @foreach ($suppliers as $item ) <option value="{{ $item->id }}">{{ $item->supplier_name }}</option> @endforeach </select> </div> </div> </div> </div> <div class="row add-new-item-form"> <div class="col-sm-6 nopadding add-new-item-field"> <div class="form-group"> <label for="">Item Name</label> <input type="text" class="form-control" id="name" name="name[]" value="" placeholder="Enter item name"> </div> </div> <div class="col-sm-6 nopadding add-new-item-field"> <div class="form-group"> <label for="">Order batch #</label> <input type="text" class="form-control" id="batch" name="batch[]" value="{{ $lastId }}" readonly> </div> </div> </div> <div class="row add-new-item-form"> <div class="col-sm-3 nopadding add-new-item-field"> <div class="form-group"> <label for="">Buying Price</label> <input type="text" class="form-control" id="supplier_price" name="supplier_price[]" value="" placeholder="Enter Buying Price"> </div> </div> <div class="col-sm-3 nopadding add-new-item-field"> <div class="form-group"> <label for="">Selling Price</label> <input type="text" class="form-control" id="selling_price" name="selling_price[]" value="" placeholder="Enter Selling Price"> </div> </div> <div class="col-sm-3 nopadding add-new-item-field mb-3"> <div class="form-group"> <label for="">Replenishment Threshold</label> <input type="number" class="form-control" id="replenish" name="replenish[]" value="" placeholder=""> </div> </div> <div class="col-sm-3 nopadding add-new-item-field"> <div class="form-group"> <label for="">Item Quantity</label> <input type="number" class="form-control" id="no_of stocks" name="no_of stocks[]" value="" placeholder=""> </div> </div> </div> <div class="mt-4 mb-2 d-flex justify-content-center"> <button class="btn btn-sm btn-danger" type="button" onclick="remove_add_category('+ room +');" style="width:100%;"> <span class="glyphicon glyphicon-minus" aria-hidden="true">&nbsp;</span>Remove Form </button> </div> <div class="clear"></div>';
                objTo.appendChild(divtest)            }
            function remove_add_category(rid) {
                $('.removeclass'+rid).remove();
            }
        </script>

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

        <script>
                $(document).ready(function () {
                    // Populate categories
                    $.get('/get-categories', function (data) {
                        data.forEach(function (category) {
                            $('#category').append($('<option>', {
                                value: category.id,
                                text: category.name
                            }));
                        });
                    });

                    // Populate suppliers based on selected category
                    $('#category').on('change', function () {
                        var category_id = $(this).val();

                        $.get('/get-suppliers', { category_id: category_id }, function (data) {
                            // Clear previous options
                            $('#supplier').empty();

                            // Populate suppliers
                            data.forEach(function (supplier) {
                                $('#supplier').append($('<option>', {
                                    value: supplier.id,
                                    text: supplier.name
                                }));
                            });
                        });
                    });

                    // Populate items based on selected category and supplier
                    $('#supplier').on('change', function () {
                        var category_id = $('#category').val();
                        var supplier_id = $(this).val();

                        $.get('/admin/getItems', { category_id: category_id, supplier_id: supplier_id }, function (data) {
                            // Clear previous options
                            $('#item').empty();

                            // Populate items
                            data.forEach(function (item) {
                                $('#item').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        });
                    });
                });
        </script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
