<?php


namespace App\Http\Controllers;




use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $uniqueFileName = $pdf->getClientOriginalName();
        $pdfFolder = public_path('pdf/' . $uniqueFileName);
        file_put_contents($pdfFolder, $pdf);


        $pdfPublicPath = public_path('pdf/' . $uniqueFileName);
        $outputPdfFile = public_path('pdf/' . $uniqueFileName) . 'Output';
        $this->fillPDFFile($pdfPublicPath,$outputPdfFile,$file);
        return response()->file($outputPdfFile);
    }
    public function fillPDFFile($pdf,$outputPdfFile,$file)
    {
        $pdfOutput = new Fpdi();
        $count = $pdfOutput->setSourceFile($pdf);
        for($i=1;$i<=$count;$i++)
        {
            $template = $pdfOutput->importPage($i);
            $size = $pdfOutput->getImportedPageSize($template);
            $pdfOutput->AddPage($size['orientation'],array($size['width'],$size['width']));
            $pdfOutput->useTemplate($template);
            if($i == $count)
            {
                $pdfOutput->Image($file);
            }
        }
        return $pdfOutput->Output($outputPdfFile,'F');
    }

}