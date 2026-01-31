<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Use the Facade alias if needed, or simply use the class

class PdfController extends Controller
{
    public function generatePdf()
    {
        $data = [
            'invoiceNumber' => 'INV-12345',
            'date' => date('Y-m-d'),
            'amount' => 129.00
        ];

        $pdf = Pdf::loadView('pdfs.invoice', $data);
        return $pdf->download('invoice.pdf'); // Forces download
        // return $pdf->stream('invoice.pdf'); // Streams the PDF to the browser
    }
}
