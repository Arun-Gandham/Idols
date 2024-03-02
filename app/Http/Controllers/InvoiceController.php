<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class InvoiceController extends Controller
{
    public function downloadInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        if (!$order) {
            return redirect()->back()->with('error', 'No Order found!');
        }
        $pdf = Pdf::loadView('templates.pdf.invoice');
        $pdfDirectory = public_path('pdf/');
        if (!File::isDirectory($pdfDirectory)) {
            File::makeDirectory($pdfDirectory, 0755, true, true);
        }
        // $pdf->save(public_path('pdf\\' . $order->name . '_' . $order_id . '_' . date("Y_M_D_H_M") . '.pdf'));
        return $pdf->download('invoice.pdf');
    }
}
