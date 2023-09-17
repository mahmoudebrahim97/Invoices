<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;

class InvoiceAttachmentsController extends Controller
{
    public function viewFile($invoice_number, $file_name)
    {
        $filePath = public_path('Attachments/' . $invoice_number . '/' . $file_name);
        return response()->file($filePath);
    }
    public function downloadFile($id)
    {
        $attachment = invoice_attachments::where('id', $id)->first();
        $filePath = public_path('Attachments/' . $attachment->invoice_number . '/' . $attachment->file_name);
        return response()->download($filePath, $attachment->file_name);
    }
    public function deleteFile($id)
    {
        $attachment = invoice_attachments::where('id', $id)->first();
        $attachment->delete();
        unlink('Attachments/' . $attachment->invoice_number . '/' . $attachment->file_name);
        return redirect()->back()->with('success', 'تم حذف المرفق بنجاح.');
    }
}
