<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class BarcodeController extends Controller
{
    //

    public  function  indexBar($data){




        // Define dynamic parameters
        $type = 'code128';

        $encodedData = base64_encode($data);

        $format = 'png';
        $text = $encodedData;


        // Encode the data using base64


// Construct the API URL with dynamic parameters
        $apiUrl = "https://barcode.orcascan.com/?type=$type&data=$encodedData&format=$format&text=" . urlencode($text);


        // Perform a HTTP request to the API
        $response = Http::get($apiUrl);

        // Set the appropriate headers for SVG content
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="barcode.png"',
        ];

        // Return the SVG content with headers
        return response($response)->withHeaders($headers);



        /// not working properly

        // Generate a unique barcode value (replace this with your own logic)
     //   $barcodeValue = '21'


//
//// Generate barcode
//        $barcode = new DNS1D();
//        $barcode->setStorPath(storage_path('app/public/barcodes')); // Set the storage path for generated barcodes
//        $barcodePath = $barcode->getBarcodePNGPath($barcodeValue, 'C39', 1, 33);
//
//// Save the barcode to the storage
//        $storagePath = 'barcode/' . $barcodeValue . '.jpeg'; // Save as JPEG
//        Storage::disk('public')->put($storagePath, file_get_contents($barcodePath));
//
//        $imagePath = storage_path('app/public/' . $storagePath);
//
//
//
//// Load the barcode image using Intervention Image
//        $barcodeImage = Image::make($imagePath);
//
//// Resize the image (adjust the width and height as needed)
//        $barcodeImage->resize(400, 200); // Adjust the size as needed
//
//// Add text below the barcode image using default font
//        $text = 'Your Additional Text Here';
//        $barcodeImage->text($text, $barcodeImage->getWidth() / 2, $barcodeImage->getHeight() + 20, function ($font) {
//            // Use default font (no need to specify a font file)
//            $font->size(14);
//            $font->color('#000000'); // Text color
//            $font->align('center');
//        });
//
//// Save the modified image as JPEG
//        $barcodeImage->save(storage_path('app/public/' . $storagePath));
//
//
//// Return a response with the barcode image for direct download
//        header('Content-Type: image/jpeg');
//        return response()->download(storage_path('app/public/' . $storagePath), $barcodeValue . '.jpeg');

    }

    public  function index($data){


        // Define dynamic parameters
        $type = 'qr';
        $format = 'png';

            // Format the number with leading zeros and the desired prefix
        $filename = sprintf('B&B-%06d', $data);

        // Encode the data using base64


// Construct the API URL with dynamic parameters
        $apiUrl = "https://barcode.orcascan.com/?type=$type&data=$data&format=$format&text=" . urlencode($filename);


// Construct the API URL with dynamic parameters
//        $apiUrl =  "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$data";

        // Perform a HTTP request to the API
        $response = Http::get($apiUrl);

        // Set the appropriate headers for SVG content
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="'.$filename.'.png"',
        ];

        // Return the SVG content with headers
        return response($response)->withHeaders($headers);


    }
}
