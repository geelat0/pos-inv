<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>

<!-- Optional JavaScript; choose one of the two! -->

<div id="reader"></div>


<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>



        var flag = true;

        function onScanSuccess(qrCodeMessage) {

            {{--var  type = $('#type').val();--}}
            {{--var  ins_ref_id =<?php echo json_encode($_SESSION['userId']); ?>;--}}
            {{--var  bs_id =<?php echo json_encode($_GET['bsid']); ?>;--}}
            {{--var  block_ref_id =<?php echo json_encode($_GET['blockid']); ?>;--}}
            {{--var  std_ref_id =   qrCodeMessage.trim();--}}

            console.log( qrCodeMessage);

            if(flag){

                // $.ajax({
                //     type: 'POST',
                //     url: 'query/scanExe.php',
                //     dataType: 'JSON',
                //     data: {
                //         'type': type,
                //         'ins_ref_id':ins_ref_id,
                //         'bs_id' : bs_id,
                //         'std_ref_id': std_ref_id,
                //         'block_ref_id':block_ref_id
                //     },
                //     beforeSend: function() {
                //
                //
                //     },
                //     error: function() { // if error occured
                //         // alert("Error occured.please try again");
                //     },
                //     success: function (data) {
                //
                //         $('.alert').hide();
                //
                //         console.log(data);
                //
                //         if(data.res=='invalidClass'){
                //
                //             $('#invalidClass').show();
                //
                //         }
                //         else if(data.res=='notexist'){
                //
                //             $('#userNotFound').show();
                //
                //         }
                //         else if(data.res =='error'){
                //
                //             alert('Contact The developer ,')
                //
                //         }
                //         else if(data.res =='failed'){
                //             $('#failed').show();
                //         }
                //
                //         else if(data.res == 'success'){
                //
                //             $('#success').show();
                //
                //         }
                //
                //
                //
                //
                //     }
                }
                //
                flag = false;
                setTimeout(()=>flag=true, 1000);
            }



        // }

        function onScanFailure(error) {
            // console.log(error);
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);




</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
