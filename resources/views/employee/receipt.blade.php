<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content=""/>
    <title>2023</title>
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

    <!-- html2canvas library -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <link href="{{ asset('css/pos.css') }}" rel="stylesheet" />

</head>

<body class="reciept-body">

<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <div class="col-sm-12 mx-5">
            <a href="/employee" style="text-decoration: none; color: #000;"><i class="bi bi-arrow-left-square-fill" style="color: #000; font-size: 24px;">&nbsp;</i>Return</a>
        </div>
    </div>

    <div id="orderSlip">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center mt-2">
                    <img src="assets/logo.png" alt="" style="width: 5%;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <h6 style="letter-spacing: 5px; font-weight: bold; margin-top: 5px;">ORDER SLIP</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <div class="card card-table-pos border-0" style="width: 50%; background-color: transparent;">
                    <div class="card-body">
                        <div class="row border-bottom">
                            <div class="col-sm-12">
                                <h6 style="font-size: 12px;">Date:&nbsp;<b>{{ $trans->created_at }}</b></h6>
                                <h6 style="font-size: 12px;">Prepared by:&nbsp;<b>{{ $trans->user->first_name  }}<span class="ms-2 me-3"> {{ $trans->user->last_name  }}</span> </b></h6>
                            </div>
                        </div>
                        <table class="table" style="">
                            <thead>
                            <tr>
                                <th class="table-th" scope="col">Item</th>
                                <th class="table-th" scope="col">Quantity</th>
                                <th class="table-th" scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($trans->orders as  $order )

                                <tr>
                                    <td class="table-td">{{ $order->item->name }}</td>
                                    <td class="table-td">{{ $order->quantity }}</td>
                                    <td class="table-td">{{ $order->amount}}</td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center">
                    <div class="card card-reciept border-0" style="width: 50%; background-color: transparent;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 style="font-size: 12px;"><b>TOTAL:&nbsp;&nbsp;&nbsp;</b><small>{{$trans->total_amount}}</small></h6>
                                    <h6 style="font-size: 12px;"><b>DISCOUNT:&nbsp;&nbsp;&nbsp;</b><small>{{$trans->discount * 100 }}  %</small></h6>
                                    <h6 style="font-size: 12px;"><b>AMOUNT RECIEVED:&nbsp;&nbsp;&nbsp;</b><small>{{$trans->amount_received}}</small></h6>
                                    <h6 style="font-size: 12px;"><b>CHANGE:&nbsp;&nbsp;&nbsp;</b><small>{{$trans->change}}</small></h6>
                                    <h6 class="" style="color: #ff0000;"><b>DUE:&nbsp;&nbsp;&nbsp;Php&nbsp;</b><small>{{$trans->total_amount_with_discount}}</small></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <!-- <div class="col-sm-12 d-flex justify-content-center">
          <button type="button" class="btn btn-primary btn-print-reciept" onclick="window.print()">RECIEPT</button>
        </div> -->
        <div class="col-sm-12 d-flex justify-content-center">
            <button class="btn btn-primary btn-print-reciept" id="printButton">Print Order Slip</button>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-sm-12 d-flex justify-content-center">
            <button class="btn btn-primary btn-print-reciept" id="downloadButton">Download Order Slip</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#printButton').on('click', function() {
            // Use html2canvas to capture the content of the order slip
            html2canvas(document.getElementById('orderSlip')).then(function(canvas) {
                // Convert the canvas content to a data URL
                var dataUrl = canvas.toDataURL('image/png');

                // Create an image element to hold the captured content
                var img = document.createElement('img');
                img.src = dataUrl;

                // Create a new window and append the image
                var printWindow = window.open('', '_blank');
                printWindow.document.body.appendChild(img);

                // Attach the load event to ensure the image is loaded before printing
                img.onload = function() {
                    printWindow.print();
                    printWindow.close();
                };
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#downloadButton').on('click', function() {
            // Use html2canvas to capture the content of the order slip
            html2canvas(document.getElementById('orderSlip')).then(function(canvas) {
                // Convert the canvas content to a data URL
                var dataUrl = canvas.toDataURL('image/png');

                // Create an anchor element for downloading
                var downloadLink = document.createElement('a');
                downloadLink.href = dataUrl;
                downloadLink.download = 'order_slip.png';

                // Append the link to the document and trigger a click
                document.body.appendChild(downloadLink);
                downloadLink.click();

                // Clean up by removing the link from the document
                document.body.removeChild(downloadLink);
            });
        });
    });
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

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
