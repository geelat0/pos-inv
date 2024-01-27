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
    @include('includes.sidebar')
        @include('includes.page-wrapper')

    <div class="container-fluid">
        <h3 class="page-title">BITS&BYTES DASHBOARD</h3>

        <div class="row row-card">
          <div class="card border-0" style="width: 100%;">
            <div class="row">
              <div class="col-sm-4">
                <div class="card-body d-flex justify-content-center">
                  <div class="row">
                      <div class="card monthly-sale-card" style="width: 100%;">
                        <div class="card-body">
                          <h4 class="card-title">Total Sale</h4>
                          <h6 class="card-subtitle mb-2 text-muted">{{ $currentMonthYear }}</h6>
                          <h1 style="color: #1d2365;"><b>P</b>{{ number_format($totalSale) }}</h1>
                        </div>
                      </div>
                      <div class="card monthly-sale-card mt-3" style="width: 100%;">
                        <div class="card-body">
                          <h4 class="card-title">Total Profit</h4>
                          <h6 class="card-subtitle mb-2 text-muted">{{ $currentMonthYear }}</h6>
                          <h1 style="color: #1d2365;"><b>P</b>{{ number_format($totalProfit) }}</h1>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="card-body">
                @if($topItem)
                  <div class="row" style="background-color: #2b3499; border: 1px solid #c6c7c6; border-radius: 10px; padding: 1%;">
                    <h2 class="card-title" style="font-weight: bold; color: #ffd099;">TOP 1 ITEM!</h2>
                    <h4 class="card-title" style=" color: #ffd099;">{{ $topItem->item->name }}</h4>
                    <p style="color: #ffd099;">{{ $topItem->item->category->category_name }}</p>
                    <p style="color: #ffd099;">QTY SOLD: {{ $topItem->totalQuantity }}</p>
                  </div>
                @else
                    <p>No top-selling item found.</p>
                @endif
                  <div class="row">
                  <table id="" class="table" style="width:100%">
                    <thead class="">
                        <tr>
                            <th>Rank#</th>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Total Qty Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($topItems as $key => $items)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $items->item->name }}</td>
                            <td>{{ $items->item->category->category_name }}</td>
                            <td>{{ $items->totalQuantity }}</td>
                        </tr>
                    @endforeach
                </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="col-sm">
        @if($itemsNeedReplenishment > 0)
            <div class="alert alert-danger" role="alert">
                Certain items need replenishment!
            </div>
        @else
            <div class="alert alert-success" role="alert" style="width: 100%;">
                All items are Full. No need to restock for now.
            </div>
        @endif
          </div>
        </div>

    <div class="graph-container">
      <!-- CONTAINER FOR THE GRAPH  -->
      <div class="" id="container" style="width: 100%;"></div>
    </div>

    <div class="container-fluid">
      <div class="row p-3">

        <!-- FILTER DATE -->
        <form id="filterForm"  action="/manager/"  method="get">
        @csrf
          <div class="row" style="margin-bottom: 10px;">
              <h4>Monthly Sales Table</h4>
              <div class="col-md-2">
                  <label for="start-date">Start Date:</label>
                  <input type="text" name="start_date" id="start-date" class="form-control" autocomplete="off">
              </div>
              <div class="col-md-2 col-end-date">
                  <label for="end-date">End Date:</label>
                  <input type="text" name="end_date"   id="end-date" class="form-control" autocomplete="off">
              </div>
              <div class="col-md-2">
                  <label for="end-date">Filter Date:</label>
                  <button class="form-control btn btn-primary" type="submit">Filter</button>
              </div>
          </div>
        </form>
        
        <!-- <div class="col-md-3 align-self-end">
                <button onclick="extractCSV()" class="btn btn-primary btn-filter-date"><i class="bi bi-printer-fill">&nbsp;</i>Download Report</button>
        </div> -->

        <table id="dataTable" class="table table-hover border p-2" style="width:100%">
            <thead class="">
                <tr>
                    <th>Date</th>
                    <th>Total Sales</th>
                    <th>Total Profit</th>
                </tr>
                <tr>
                    <th style="color: #12c300; font-size: 14px;">Total:</th>
                    <th style="color: #12c300; font-size: 14px;">{{ number_format($data->sum('total_amount'), 2) }}</th>
                    <th style="color: #12c300; font-size: 14px;">{{ number_format($data->sum('total_profit'), 2) }}</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            @forelse($data as $item)
                <tr>
                    <td>{{ $item->formatted_date }}</td>
                    <td>{{ $item->total_amount }}</td>
                    <td>{{ $item->total_profit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="number_of_columns">No data found</td>
                </tr>
            @endforelse
            </tbody>

            
        </table>
      </div>
    </div>

     <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
     <script>window.jQuery || document.write('<script src="js/jquery-1.8.3.min.js"><\/script>')</script>
     <script src="http://code.highcharts.com/highcharts.js"></script>
     <script src="http://code.highcharts.com/highcharts-more.js"></script>
     <script src="http://code.highcharts.com/modules/exporting.js"></script>

    <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'BITS&BYTES Monthly Sales Graph',
                    align: 'left'
                },
                subtitle: {
                    text: 'Source: <a target="_blank" href="#">Bits&Bytes</a>',
                    align: 'left'
                },
                xAxis: {
                    categories: <?php echo json_encode(array_column($chartData, 'name')); ?>,
                    crosshair: true,
                    accessibility: {
                        description: 'Month'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Sales'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: 'Total Sales',
                        data: <?php echo json_encode(array_values(array_column($chartData, 'sales'))); ?>
                        
                    },
                ]
            });
    </script>


<!-- ------------------------------------------------------------------ -->
    <!-- FILTER DATE -->
    <script>
        $(document).ready(function(){
            // Initialize datepicker for the start date
            $('#start-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            // Initialize datepicker for the end date
            $('#end-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>


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