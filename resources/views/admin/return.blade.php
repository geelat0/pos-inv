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
                <div class="container-fluid">
                    <h3 class="page-title">RETURNED ITEMS</h3>
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
                        <div class="row row-add-user d-flex flex-row-reverse">
                            <button type="button" class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#return-item">Add Item</button>
                        </div>
                    <div class="row p-3">
                        <table id="example" class="table table-hover border p-2" style="width:100%">
                            <thead class="">
                                <tr>
                                    <th>Date Purchased</th>
                                    <th>Date Returned</th>
                                    <th>Item</th>
                                    <th>Reason</th>
                                    <th>Purchased to</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($return_items as $item )
                                <tr>
                                    <td>{{$item->purchase_date}}</td>
                                    <td>{{$item->return_date}}</td>
                                    <td>{{$item->item->name}}</td>
                                    <td>{{$item->return_ground}}</td>
                                    <td>{{ $item->user->first_name . ' ' . $item->user->last_name }}</td>
                                    <td><button type="button" class="btn btn-upd-user" data-toggle="tooltip" data-placement="top" title="Remove" data-bs-toggle="modal" data-bs-target="#remove{{ $item->id }}"><i class="bi bi-trash-fill"></i></button></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div style="margin-top: 3%;">
                        <div class="row">
                            <h3 class="page-title" style="">RETURN GROUNDS</h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#add-return-ground" style="width: 20%;">Add Return Grounds</button>
                                        </div>
                                        @foreach ($grounds as $item )
                                        <ul>
                                       
                                            <li><h6><b>{{$item->title}}:&nbsp;</b><small>{{$item->desc}}</small></h6></li>
                                        
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ADD RETURN ITEM -->

        <div class="modal" id="return-item">
            <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h5 class="modal-title"><i class="bi bi-cart-fill" style="font-size: 24px;">&nbsp;</i>Add Returned Item</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- Modal Body -->
                <form id="" action="/admin/add-return" method="post">
                @csrf
                @method('post')
                  <div class="modal-body">
                      <div>
                         <div class="mb-3">
                              <label for="">Transaction Number</label>
                              <input type="text" class="form-control" id="" name = "transaction_id" placeholder="" required>
                          </div> 
                          <div class="mb-3">
                              <label for="">Date Purchased</label>
                              <input type="date" class="form-control" id="" name = "purchased_date" placeholder="" required>
                          </div>
                          <div class="mb-3">
                              <label for="">Date Returned</label>
                              <input type="date" class="form-control" id="" name ="return_date" placeholder="" required>
                          </div>
                          <div class="mb-3">
                              <select class="selectpicker form-control"  name="ground_id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                  <option selected="true" disabled="disabled">Reason</option>
                                  <@foreach ($grounds as $item )
                                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                                    @endforeach
                                  <!-- Add more options as needed -->
                              </select>
                          </div>
                          <div class="mb-3">
                            <input type="text" class="form-control" id="item-search" name = "query" placeholder="Search items...">
                                <ul class="list-group" id="item-list">
                                </ul>
                            <input type="hidden" name="item_id" id="selected-item-id">
                          </div>
                          <div class="mb-3">
                              <select class="selectpicker form-control" name="user_id" data-live-search="true" data-style="btn-primary" data-width="200px" required>
                                  <option selected="true" disabled="disabled">Purchased To</option>
                                  <@foreach ($users as $item )
                                        <option value="{{ $item->id }}">{{ $item->first_name . ' ' . $item->last_name }}</option>
                                    @endforeach
                                  <!-- Add more options as needed -->
                              </select>
                          </div>
                      </div>
                  </div>
                  <!-- Modal Footer (optional) -->
                  <div class="modal-footer d-flex justify-content-center">
                      <p style="font-size: 10px; color: #ff0000;">Please <b>Verify</b> the information above before submitting.</p>
                      <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                  </div>
                </form>
                </div>
            </div>
        </div>

        <!-- ADD RETURN GROUNDS MODAL -->

        <div class="modal" id="add-return-ground">
            <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h5 class="modal-title"><i class="bi bi-card-list" style="font-size: 24px;">&nbsp;</i>Add Return Grounds</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- Modal Body -->
                <form id="" action = "/admin/add-grounds" method="post">
                @csrf
                @method('post')
                  <div class="modal-body">
                      <div>
                          <div class="mb-3">
                              <input type="text" class="form-control" id="" name = "title" placeholder="Add Ground Title" required>
                          </div>
                          <div class="mb-3">
                            <textarea class="form-control" id="Input description" name="desc" rows="3"></textarea>
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

        <!-- REMOVE ITEM -->
        @foreach ($return_items as $item )
            <div class="modal" id="remove{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div>
                                <h5 class="d-flex justify-content-center">Are you sure you want to Remove this Item?</h5>
                            </div>
                        </div>
                        <!-- Modal Footer (optional) -->

                        <form method="post" action="/admin/remove">
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

      

        <script>
            $(document).ready(function () {
                $('#item-search').on('input', function () {
                    var searchTerm = $(this).val();

                    $.ajax({
                        url: '/admin/search',
                        type: 'GET',
                        data: {term: searchTerm},
                        success: function (response) {
                            displayItems(response);
                        }
                    });
                });

                function displayItems(items) {
                    var itemList = $('#item-list');
                    itemList.empty();

                    items.forEach(function (item) {
                        // Only display items whose names start with the inputted term
                        if (item.name.toLowerCase().startsWith($('#item-search').val().toLowerCase())) {
                            var listItem = $('<li class="list-group-item" style="color: #000;">')
                                .text(item.name)
                                .click(function () {
                                    $('#item-search').val(item.name);
                                    $('#selected-item-id').val(item.id);
                                    itemList.empty();
                                });

                            itemList.append(listItem);
                        }
                    });
                }
            });
    </script>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>