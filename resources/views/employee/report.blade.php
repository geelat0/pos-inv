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

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <link href="{{ asset('css/manage-user.css') }}" rel="stylesheet" />




</head>
<body>

@include('includes.navbar-pos')



<div class="container-fluid">
    <div class="row p-3">
        <div class="col-md-12">
            <!-- FILTER DATE -->
            <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%;">
                <button onclick="printTable()"  id="printButton" class="btn btn-primary"><i class="bi bi-printer-fill">&nbsp;</i>Print Report</button>
                <button onclick="extractCSV()" class="btn btn-primary"><i class="bi bi-printer-fill">&nbsp;</i>Download Report</button>
            </div>
        </div>
    </div>
    <div class="row p-3">
        <table id="dataTable" class="table table-hover border p-2" style="width:100%">
            <thead class="">
            <tr>
                <th>Transaction Date</th>
                <th>Receipt Number</th>
                <th>Total Amount</th>
            </tr>

            </thead>
            <tbody id="tableBody">


            @foreach($trans as $t)
                <tr>
                    <td>{{ $t->created_at  }}</td>
                    <td>{{ $t->id  }}</td>
                    <td>{{ $t->total_amount_with_discount  }}</td>
                </tr>

            @endforeach


            </tbody>


        </table>
    </div>
</div>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
<script>window.jQuery || document.write('<script src="js/jquery-1.8.3.min.js"><\/script>')</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>




<!-- ------------------------------------------------------- -->
<!-- MODAL SCRIPT -->
<script>
    function openModal() {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    }
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<!-- PRINTING SCRIPT -->

<script>
    function printTable() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Daily Report</title></head><body>');
        printWindow.document.write('<style>@media print{table{border-collapse: collapse;width: 100%;}table, th, td{border: 1px solid black;}th, td{padding: 8px;text-align: left;}}</style>');
        printWindow.document.write(document.querySelector('table').outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

<!-- GENERATE CSV FILE -->

<script>
    function extractCSV() {
        // Get table data
        var table = document.getElementById("dataTable"); // Replace "yourTableId" with the actual ID of your table
        var rows = table.querySelectorAll("tbody tr");
        var header = table.querySelectorAll("thead tr")[0];

        // Create CSV content with header
        var csvContent = "data:text/csv;charset=utf-8,";

        // Include header row
        var headerData = [];
        header.querySelectorAll("th").forEach(function (cell) {
            headerData.push(cell.innerText);
        });
        csvContent += headerData.join(",") + "\n";

        // Include data rows
        rows.forEach(function (row) {
            var rowData = [];
            row.querySelectorAll("td").forEach(function (cell) {
                rowData.push(cell.innerText);
            });
            csvContent += rowData.join(",") + "\n";
        });

        // Create a download link and trigger the download
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "sales_report.csv");
        document.body.appendChild(link); // Required for Firefox
        link.click();
        document.body.removeChild(link);
    }
</script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>


<!-- ------------------------------------------------------- -->
</body>
</html>
