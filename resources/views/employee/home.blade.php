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



{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}



    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* In order to place the tracking correctly */
        canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 0;
            top: 0;
        }
    </style>


    <style>
        #myAudio {
            display: none;
        }
    </style>

    <link href="{{ asset('css/pos.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/pos-nav.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/manage-user.css') }}" rel="stylesheet" />

    <script src="{{ asset('js/html5-qrcode.min.js') }}">  </script>



</head>
<body  style="overflow:hidden;">

    <div>

@include('includes.navbar-pos')


<audio id="myAudio" controls>
    <source src="{{ asset('assets/check.mp3') }}" type="audio/mp3">
    Your browser does not support the audio element.
</audio>


<div class="container-fluid" style="">
    <div class="row" style="margin-top: 30px;">


            @if(session('void_mode'))
            <div class="alert alert-danger text-center" role="alert">
                <h4>Void Item</h4>
                <a href="/employee/void-done"  class="btn btn-primary">logout as Manager</a>
            </div>
            @endif


        <div class="col-sm-12 d-flex justify-content-center cam-container-row">
            <span class="cam-container" id="reader"></span>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card card-table-pos border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="row mb-2">

                        <div class="col-sm-12">
                            <h6>Date:&nbsp;<b>{{ now() }}</b></h6>
                            <h6>Employee Name:&nbsp;<b>{{ \Illuminate\Support\Facades\Auth::user()->first_name }}  </b> <b>{{\Illuminate\Support\Facades\Auth::user()->last_name }}    </b></h6>
                        </div>
                    </div>
                    <div style="height:200px;overflow-y:scroll;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody  id="order-table">

                        @php
                            $totalAmount = 0; // Initialize total amount variable
                        @endphp

                        @foreach($cart as $c)
                            <tr>
                                <td class="text-uppercase">{{ $c->item->name }}</td>
                                <td><input type="number" class="form-control quantity-input" data-id="{{$c->id}}" value="{{ $c->quantity }}"></td>
                                <td>{{ number_format($c->amount * $c->quantity, 2) }}</td>

                                @if(session('void_mode'))
                                    <!-- This element will be hidden if void_mode is true -->
                                    <td class="text-uppercase"> <button class="btn btn-sm btn-danger  btn-void "  data-id="{{$c->id}}">Remove</button></td>
                                @endif

                            </tr>

                            @php
                                $totalAmount += $c->amount * $c->quantity; // Update total amount
                            @endphp
                        @endforeach

                        {{--                        <tr>--}}
{{--                            <td>Item 1</td>--}}
{{--                            <td><input type="number" class="form-control" id="" placeholder="Item Quantity"></td>--}}
{{--                            <td>20</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Item 1</td>--}}
{{--                            <td><input type="number" class="form-control" id="" placeholder="Item Quantity"></td>--}}
{{--                            <td>20</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Item 1</td>--}}
{{--                            <td><input type="number" class="form-control" id="" placeholder="Item Quantity"></td>--}}
{{--                            <td>20</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Item 1</td>--}}
{{--                            <td><input type="number" class="form-control" id="" placeholder="Item Quantity"></td>--}}
{{--                            <td>20</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Item 1</td>--}}
{{--                            <td><input type="number" class="form-control" id="" placeholder="Item Quantity"></td>--}}
{{--                            <td>20</td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="row m-2">
                        <div class="col-sm-6" syle="">
                            <button type="button" class="btn btn-primary btn-square-md" data-bs-toggle="modal" data-bs-target="#add-item"  @if(session()->has('void_mode')) disabled @endif>ADD ITEM</button>
                        </div>

                        <div class="col-sm-6" syle="">
                            <button type="button" class="btn btn-primary btn-square-md" data-bs-toggle="modal" data-bs-target="#void" @if(session()->has('void_mode')) disabled @endif>VOID</button>
                        </div>

                    </div>

                    <div class="row m-2">
{{--                        <div class="col-sm-12">--}}
{{--                            <!-- <div class="mt-3 mb-3">--}}
{{--                                <label for="">Amount Recieved</label>--}}
{{--                                <input type="text" class="form-control" id="numberInput" name="numberInput" placeholder="Enter Amount Recieved" required>--}}
{{--                            </div> -->--}}
{{--                            <form id="myForm">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="numberInput">Amount Recieve:</label>--}}
{{--                                    <input type="text" class="form-control" id="numberInput" name="numberInput">--}}
{{--                                    <small id="error" class="form-text text-danger"></small>--}}
{{--                                </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="row m-3">
                        <div class="col-sm-6">
                            <h5><b>TOTAL:&nbsp;&nbsp;&nbsp;</b> <input id="total-amount" type="text" value="{{ number_format($totalAmount, 2) }}" disabled></h5>
{{--                            <h5><b>DISCOUNT:&nbsp;&nbsp;&nbsp;</b><small>10%</small></h5>--}}
{{--                            <h5><b>AMOUNT RECIEVED:&nbsp;&nbsp;&nbsp;</b><small>200</small></h5>--}}
                        </div>
                        <div class="col-sm-6">
{{--                            <h5><b>CHANGE:&nbsp;&nbsp;&nbsp;</b><small>110</small></h5>--}}
{{--                            <h5><b>TOTAL BILL:&nbsp;&nbsp;&nbsp;</b><small>90</small></h5>--}}
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <!-- <a href="reciept.php" type="submit" value="Submit" class="btn btn-primary btn-print-reciept" disabled>ENTER</a> -->
{{--                            <button type="submit" class="btn btn-primary btn-print-reciept" formaction="http://localhost/pos-inv-system/pos/reciept.php" disabled>Enter</button>--}}



                                <button type="button" class="btn btn-primary   btn-print-reciept" data-bs-toggle="modal" data-bs-target="#change"  @if(session()->has('void_mode')) disabled @endif>ENTER</button>

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
                <h5 class="modal-title"><i class="bi bi-cart-check-fill" style="font-size: 24px;" >&nbsp;</i>Add Item Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-labelpx="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div style="width: 100%;">


                        <div class="mb-3">
                            <input type="text" class="form-control" id="enter-item" placeholder="Enter Item Code or Name" required>
                        </div>

                        <div class="mb-3 " >

                            <div class="container" id="result-container">

                            </div>


                        </div>



                </div>
            </div>
            <!-- Modal Footer (optional) -->

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


<div class="modal" id="change">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Pay Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    <form id="pay-form" method="post">
                        <div class="mb-3">
                            <!-- DISCOUNT IS IN PERCENTAGE ONLY -->

                            @csrf

                            <h5><b>TOTAL:</b></h5>
                            <input type="text" class="form-control" id="modal-total" name="total_amount" placeholder="" value="{{ str_replace(',', '', number_format($totalAmount, 2)) }}" required readonly>

                            <h5><b>DISCOUNT:</b></h5>

                            <input type="number" class="form-control" id="modal-discount" value="0" placeholder="0%"  max="100"  name="discount" required>
                            <p style="font-size: 10px; color: #ff0000;">The reduction is expressed as a percentage.</p>


                            <h5><b>GRAND TOTAL:</b></h5>
                            <input type="" class="form-control" id="modal-grandtotal" placeholder="" name="total_amount_with_discount" required readonly>

                            <h5><b>AMOUNT RECIEVED:</b></h5>
                            <input type="" class="form-control" id="modal-amountrecieved"  placeholder="" required name="amount_received">
                            <div class="alert alert-danger mt-5" role="alert" id="error-amount">

                                Not enough Amount
                            </div>


                            <h5><b>CHANGE</b></h5>
                            <input type="" class="form-control" id="modal-change" placeholder="" required  name="change" readonly>



                        </div>
                </div>
            </div>
            <!-- Modal Footer (optional) -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 100%;"  @if(session()->has('void_mode')) disabled @endif>Enter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- VOID -->

<div class="modal" id="void">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title">Login to Void</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <form  method="post" id="void-form">

                @csrf()
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password"  required class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                </div>
                <!-- Modal Footer (optional) -->
                <div class="modal-footer d-flex justify-content-center border-0">
                    <!-- ONLY MANAGER AND ADMIN CAN VOID THE ITEM -->
                    <!-- THIS WILL JUMP TO VOID PAGE -->


                        <!-- This element will be hidden if void_mode is true -->
                    <button type="submit" class="btn btn-primary" style="width: 50%;" @if(session()->has('void_mode')) disabled @endif>
                        Enter
                    </button>




                </div>
            </form>
        </div>
    </div>
</div>


<!-- VALIDATING NUMBERS ONLY -->
<script>

    // Function to update grand total based on discount
    function updateGrandTotal() {
        // Get the total amount
        var totalAmount = parseFloat($('#modal-total').val());

        // Get the discount percentage
        var discountPercentage = parseFloat($('#modal-discount').val());

        // Calculate the discounted amount
        var discountedAmount = totalAmount * (discountPercentage / 100);

        // Calculate the grand total after discount
        var grandTotal = totalAmount - discountedAmount;

        // Update the grand total input field
        $('#modal-grandtotal').val(grandTotal.toFixed(2));
    }

    $('#error-amount').hide();
    // Function to update change amount based on received amount
    function updateChange() {
        // Get the grand total
        var grandTotal = parseFloat($('#modal-grandtotal').val());

        // Get the received amount
        var receivedAmount = parseFloat($('#modal-amountrecieved').val());

        // Validate that received amount is greater than or equal to grand total
        if (receivedAmount >= grandTotal) {
            // Calculate the change amount
            var changeAmount = receivedAmount - grandTotal;

            // Display the change amount
            $('#modal-change').val(changeAmount.toFixed(2));
            $('#error-amount').hide();
        } else {
            // Reset change amount if received amount is less than grand total
            $('#modal-change').val('');
            $('#error-amount').show();
        }
    }

    // Attach onchange event to the discount input
    $('#modal-discount').on('change', function () {
        // Call the updateGrandTotal function when the discount changes
        updateGrandTotal();
    });

    // Attach onchange event to the received amount input
    $('#modal-amountrecieved').on('change', function () {
        // Call the updateChange function when the received amount changes
        updateChange();
    });

    // Initial update when the page loads
    updateGrandTotal();
    updateChange(); // Update change amount based on initial values
    // Function to validate numbers on input
    function validateNumbers(input) {
        var errorElement = $('#error');
        var submitButton = $('button[type="submit"]');

        // Clear previous error message
        errorElement.text('');

        // Check if the input contains only numbers
        if (/^\d+$/.test(input)) {
            submitButton.prop('disabled', false);
        } else {
            submitButton.prop('disabled', true);
            errorElement.text('Please enter correct amount');
        }
    }

    // Add an input event listener for real-time validation using jQuery
    $('#numberInput').on('input', function() {
        // Get the input value
        var input = $(this).val();

        // Perform real-time validation
        validateNumbers(input);
    });

    // Add a submit event listener for final validation
    $('#myForm').on('submit', function(event) {
        // Prevent the form from submitting if it's not valid
        if ($('button[type="submit"]').prop('disabled')) {
            event.preventDefault();
            alert('Form submission prevented. Please enter numbers only.');
        }
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


    function  voidItem(){
        $('.btn-void').on('click', function() {
            // Get the new value when the input changes

            var button = this;

            // Get the item ID from the data-id attribute
            var id = $(this).data('id');


            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Reference to the current input field


            $.ajax({
                type: "post",
                url: "/employee/void-item",
                data: { id: id, _token: csrfToken },
                success: function(response) {
                    // Handle the successful response from the server
                    console.log(response);


                    if(response.success){
                        button.closest('tr').remove();

                    }










                },
                error: function(error) {
                    // Handle errors
                    console.log("Error:", error);
                }
            });
        });
    }

    voidItem();
    function  renderOrder(data) {
        $('#order-table').empty();


        var totalAmount = 0;

        $.each(data, function(index, item) {
            var row = $('<tr>');

            var lineTotal = parseFloat(item.quantity) * parseFloat(item.amount);
            totalAmount += lineTotal; // Update totalAmount

            // Add cells to the row
            row.append('<td class="text-uppercase">' + item.item.name + '</td>');
            row.append('<td><input type="number" class="form-control quantity-input" data-id="' + item.id + '" value="' + item.quantity + '"></td>');

            row.append('<td>' + (parseFloat(item.quantity) * parseFloat(item.amount)).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</td>');

            // row.append('<td class="text-uppercase"> <button class="btn btn-sm btn-danger  btn-void "   data-id="' + item.id + '">Remove</button></td>');

            // Append the row to the result-container
            $('#order-table').prepend(row);

        });

        $('#total-amount').val( totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#modal-total').val(totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace(/,/g, ''));




        quantityButton();
    }



    function  quantityButton(){

        var old =     $('.quantity-input').val();

        $('.quantity-input').on('change', function() {
            // Get the new value when the input changes
            var new_quantity = $(this).val();





            // Get the item ID from the data-id attribute
            var id = $(this).data('id');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var old_quantity = $(this).data('old-quantity');


            // Reference to the current input field
            var $inputField = $(this);

            $.ajax({
                type: "post",
                url: "/employee/change-quantity",
                data: { id: id, _token: csrfToken, new_quantity: new_quantity },
                success: function(response) {
                    // Handle the successful response from the server
                    console.log(response);



                    if(response.data){

                        location.reload(); //  temp fix

                        // Assuming the server response contains the updated value
                        var updatedValue = response.response; // Adjust this based on your actual response

                        // Update the corresponding <td> with the new value
                        $inputField.closest('tr').find('td:last').text(updatedValue);

                        var to_add = parseFloat(response.new_total_amount); // Value to adds\

                        $('#total-amount').val( to_add.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

                        $('#modal-total').val(to_add.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace(/,/g, ''));

                        renderOrder(response.data)
                        $("#myAudio")[0].play();
                    }else{
                        alert(response.message);
                    }










                },
                error: function(error) {
                    // Handle errors
                    console.log("Error:", error);
                }
            });
        });

    }
    quantityButton();

    // Add a keyup event handler to the input field
    $("#enter-item").keyup(function() {
        // Get the value from the input field
        var searchTerm = $(this).val();

        // Make an AJAX request only if the search term is not empty
        if (searchTerm.trim() !== "") {
            // Make an AJAX request
            $.ajax({
                type: "GET", // Use "GET" or "POST" depending on your needs
                url: "/employee/items",
                data: { term: searchTerm }, // Pass the search term to the server
                success: function(response) {
                    // Handle the successful response from the server

                    if (response.length === 0) {
                        $('#result-container').empty();
                        $('#result-container').append('<p>No results found.</p>');
                    } else {
                        // Use $.each() to iterate over the array
                        $('#result-container').empty();
                        $.each(response, function(index, item) {

                            // Create a new row
                            var row = $('<div class="row"></div>');

                            // Create the col-sm-8 div with the text
                            var col8 = $('<div class="col-sm-8"></div>').append('<p class="text-uppercase">' + item.name +  ' - ₱ ' +  item.selling_price  +'</p>');

                            // Create the col-sm-4 div with the "Add" button
                            var col4 = $('<div class="col-sm-4"></div>').append(`<button type="submit"  data-id="${item.id}" class=" btn-add btn btn-primary btn-sm">Add</button>`);

                            // Append the col8 and col4 to the row
                            row.append(col8).append(col4);

                            // Append the row to the result-container

                            $('#result-container').append(row);
                        });

                    }

                    //

                    $('.btn-add').click(function() {
                        // Add the class "btn-add-clicked" when the button is clicked
                        var id  = $(this).attr('data-id');



                        var csrfToken = $('meta[name="csrf-token"]').attr('content');


                        $.ajax({
                            type: "post", // Use "GET" or "POST" depending on your needs
                            url: "/employee/add-cart",
                            data: { id: id , _token:csrfToken }, // Pass the search term to the server
                            success: function(data) {
                                // Handle the successful response from the server
                                console.log(data);



                                if(data.data){
                                    renderOrder(data.data)
                                    $("#myAudio")[0].play();
                                }else{
                                    alert(data.message);
                                }







                            },
                            error: function(error) {
                                // Handle errors
                                console.log("Error:", error);
                            }
                        });


                    });


                },
                error: function(error) {
                    // Handle errors
                    console.log("Error:", error);
                }
            });
        } else {
            // Clear the search results if the search term is empty
            $("#search-results").html("");
        }
    });


</script>



<script>

    $(function() {

        const toTitleCase = (phrase) => {
            return phrase
                .toLowerCase()
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        };
        // standby


        var flag = true;

        function onScanSuccess(qrCodeMessage) {




            if(flag){
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "post", // Use "GET" or "POST" depending on your needs
                    url: "/employee/add-cart",
                    data: { id: qrCodeMessage , _token:csrfToken }, // Pass the search term to the server

                    beforeSend: function() {


                    },
                    error: function() { // if error occured
                        // alert("Error occured.please try again");
                    },
                    dataType: 'json',
                    success: function (data) {

                        console.log(data);
                        console.log('Data success:', data.success);


                        if(data.message){
                            alert(data.message)
                        }

                        if (data && data.data && data.data.length > 0) {
                            // The "data" array has values and is not empty
                            // You can access the data inside the array like data.data[0].id, data.data[0].quantity, etc.
                            renderOrder(data.data)
                            $("#myAudio")[0].play();
                        }



                        //
                        // if(data.data){
                        //     renderOrder(data.data)
                        // }else{
                        //     alert(data.message);
                        // }
                        //
                        //
                        //
                        //
                        //
                        // if(data.data){
                        //     renderOrder(data.data)
                        // }else{
                        //     alert(data.message);
                        // }



                    }
                });
                //
                flag = false;
                setTimeout(()=>flag=true, 3000);
            }



        }

        function onScanFailure(error) {

        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        //pay-form"



        $('.btn-print-reciept').click(function (e) {

                var modal_total = $('#modal-total').val();
               $('#modal-grandtotal').val(modal_total);
               $('#modal-amountrecieved').val('');
               $('#modal-discount').val(0);



        });



        // When the button is clicked
        $('#pay-form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission




            // Get the grand total
            var grandTotal = parseFloat($('#modal-grandtotal').val());

            // Get the received amount
            var receivedAmount = parseFloat($('#modal-amountrecieved').val());

            // Validate that received amount is greater than or equal to grand total
            if (receivedAmount >= grandTotal) {
                // Calculate the change amount
                var changeAmount = receivedAmount - grandTotal;

                // Display the change amount
                $('#modal-change').val(changeAmount.toFixed(2));
                $('#error-amount').hide();


            } else {
                // Reset change amount if received amount is less than grand total
                $('#modal-change').val('');
                $('#error-amount').show();

                return;

            }

            // Your custom logic goes here
            // For example, you can perform some validation before submitting the form

            // If everything is okay, you can submit the form using AJAX
            $.ajax({
                type: 'POST', // or 'GET'
                url: '/employee/pay-now', // Replace with your server endpoint
                data: $('#pay-form').serialize(), // Serialize the form data
                success: function (response) {
                    // Handle the success response from the server
                    console.log(response);

                    if(response.success){
                        location.href = '/employee/receipt/' + response.id ;
                    }else{
                        alert('Somethin went wrong');
                    }


                },
                error: function (error) {
                    // Handle the error response from the server
                    console.error(error);
                }
            });
        });




        // When the button is clicked
        $('#void-form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Your custom logic goes here
            // For example, you can perform some validation before submitting the form



            // If everything is okay, you can submit the form using AJAX
            $.ajax({
                type: 'POST', // or 'GET'
                url: '/employee/void-login', // Replace with your server endpoint
                data: $('#void-form').serialize(), // Serialize the form data
                success: function (response) {
                    // Handle the success response from the server
                    console.log(response);


                    if(response.success){
                            location.reload();
                    }else{
                        alert(response.message);
                    }




                },
                error: function (error) {
                    // Handle the error response from the server
                    console.error(error);
                }
            });
        });


    });

</script>









<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
{{--<script src="js/scripts.js"></script>--}}

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </div>

</body>
</html>
