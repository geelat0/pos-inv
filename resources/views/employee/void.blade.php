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

    <link href="{{ asset('css/pos.css') }}" rel="stylesheet" />



</head>
<body>
@include('includes.navbar-pos')

<div class="container-fluid" style="padding: 10px;">
    <h3 class="page-title">VOID ITEM</h3>
    <div class="row mt-3" style="color: blue;">
        <div class="col-sm-6">
            <div class="card card-table-pos border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h6>Date:&nbsp;<b>11/15/2023</b></h6>
                            <h6>Employee Name:&nbsp;<b>Employee1</b></h6>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Item 1</td>
                            <td><input type="number" class="form-control" id="" placeholder="Item Quantity"></td>
                            <td>20</td>
                            <td><button class="btn btn-sm btn-danger">Remove</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="row m-2">
                        <div class="col-sm-6" syle="">
                            <button type="button" class="btn btn-primary btn-square-md" data-bs-toggle="modal" data-bs-target="#add-item">ADD ITEM</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary btn-square-md" data-bs-toggle="modal" data-bs-target="#discount">DISCOUNT</button>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-sm-6">
                            <h5><b>TOTAL:&nbsp;&nbsp;&nbsp;</b><small>100</small></h5>
                            <h5><b>DISCOUNT:&nbsp;&nbsp;&nbsp;</b><small>10%</small></h5>
                            <h5><b>AMOUNT RECIEVED:&nbsp;&nbsp;&nbsp;</b><small>200</small></h5>
                        </div>
                        <div class="col-sm-6">
                            <h5><b>CHANGE:&nbsp;&nbsp;&nbsp;</b><small>110</small></h5>
                            <h5><b>TOTAL BILL:&nbsp;&nbsp;&nbsp;</b><small>90</small></h5>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <a href="/" type="button" class="btn btn-primary btn-print-reciept">Done</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD ITEM -->
<div class="modal" id="add-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cart-check-fill" style="font-size: 24px;">&nbsp;</i>Add Item Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-labelpx="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <form id="">
                        <div class="mb-3">
                            <h6><b>Item Name: &nbsp;</b>Show Item Name Here</h6>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" placeholder="Enter Item Code" required>
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

<!-- DISCOUNT -->
<div class="modal" id="discount">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <form id="new-category">
                        <div class="mb-3">
                            <!-- DISCOUNT IS IN PERCENTAGE ONLY -->
                            <input type="number" class="form-control" id="" placeholder="0%" required>
                            <p style="font-size: 10px; color: #ff0000;">The reduction is expressed as a percentage.</p>
                        </div>
                </div>
            </div>
            <!-- Modal Footer (optional) -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Enter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ENABLE SUPPLIER -->

<div class="modal" id="enable-supplier-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <h5 class="d-flex justify-content-center">Are you sure you want to Enable this Supplier?</h5>
                </div>
            </div>
            <!-- Modal Footer (optional) -->
            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="btn btn-dark" style="width: 20%;">Yes</button>
                <button type="button" class="btn btn-danger" style="width: 40%;">No</button>
            </div>
        </div>
    </div>
</div>

<!-- DISABLE SUPPLIER -->

<div class="modal" id="disable-supplier-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <h5 class="d-flex justify-content-center">Are you sure you want to Disable this Supplier?</h5>
                </div>
            </div>
            <!-- Modal Footer (optional) -->
            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="btn btn-dark" style="width: 20%;">Yes</button>
                <button type="button" class="btn btn-danger" style="width: 40%;">No</button>
            </div>
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
<script src="js/scripts.js"></script>
</body>
</html>
