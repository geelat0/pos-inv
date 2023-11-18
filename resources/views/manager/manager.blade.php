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
                          <h6 class="card-subtitle mb-2 text-muted">Present Date</h6>
                          <h1 style="color: #1d2365;"><b>P</b>155000</h1>
                        </div>
                      </div>
                      <div class="card monthly-sale-card mt-3" style="width: 100%;">
                        <div class="card-body">
                          <h4 class="card-title">Total Profit</h4>
                          <h6 class="card-subtitle mb-2 text-muted">Present Date</h6>
                          <h1 style="color: #1d2365;"><b>P</b>15000</h1>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="card-body">
                  <div class="row" style="background-color: #2b3499; border: 1px solid #c6c7c6; border-radius: 10px; padding: 1%;">
                    <h2 class="card-title" style="font-weight: bold; color: #ffd099;">TOP 1 ITEM!</h2>
                    <h4 class="card-title" style=" color: #ffd099;">Item name here</h4>
                    <p style="color: #ffd099;">Category 1</p>
                  </div>
                  <div class="row">
                  <table id="" class="table" style="width:100%">
                    <thead class="">
                        <tr>
                            <th>Rank#</th>
                            <th>Item</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>Item2</td>
                            <td>Category1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Item3</td>
                            <td>Category2</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Item3</td>
                            <td>Category2</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Item3</td>
                            <td>Category2</td>
                        </tr>
                </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="col-sm">
            <div class="alert alert-success" role="alert" style="width: 100%;">
              All items are Full. No need to restock for now.
            </div>
            <div class="alert alert-danger" role="alert">
              Certain items need replenishment!
            </div>
          </div>
        </div>

    <div class="graph-container">
      <!-- CONTAINER FOR THE GRAPH  -->
      <div class="" id="container" style="width: 100%;"></div>
    </div>

    <div class="container-fluid">
      <div class="row p-3">

        <!-- FILTER DATE -->
        <form action="">
          <div class="row" style="margin-bottom: 10px;">
              <h4>Monthly Sales Table</h4>
              <div class="col-md-3">
                  <label for="start-date">Start Date:</label>
                  <input type="text" id="start-date" class="form-control" autocomplete="off">
              </div>
              <div class="col-md-3 col-end-date">
                  <label for="end-date">End Date:</label>
                  <input type="text" id="end-date" class="form-control" autocomplete="off">
              </div>
              <div class="col-md-3 align-self-end">
                <button class="btn btn-primary btn-filter-date"><i class="bi bi-printer-fill">&nbsp;</i>Download Report</button>
              </div>
          </div>
        </form>

        <table id="example" class="table table-hover border p-2" style="width:100%">
            <thead class="">
                <tr>
                    <th>Date</th>
                    <th>Total Sales</th>
                    <th>Total Profit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>11/11/2023</td>
                    <td>150000</td>
                    <td>15000</td>
                </tr>
                <tr>
                    <td>11/12/2023</td>
                    <td>150000</td>
                    <td>15000</td>
                </tr>
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
                text:
                    'Source: <a target="_blank" ' +
                    'href="#">Bits&Bytes</a>',
                align: 'left'
            },
            xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
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
                    name: 'Total Sales per Month',
                    data: [406292, 260000, 107000, 68300, 27500, 14500, 406292, 260000, 107000, 68300, 27500, 14500]
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
                $('#example').DataTable();
            });
        </script>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>


<!-- ------------------------------------------------------- -->
    </body>
</html>