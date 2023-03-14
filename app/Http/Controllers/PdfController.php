<?php


namespace App\Http\Controllers;






use Illuminate\Http\Request;

class PdfController extends  Controller
{
    public function storePdf(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf'
        ]);
        $data_uri = $request->signature_data;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $folderPath = public_path('images/');
        $file = $folderPath . uniqid() .  '.png';
        file_put_contents($file, $decoded_image);
        $pdf = $request->file;
        dd($pdf);

    }
}