<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoice_attachments;
use App\Models\invoices_details;
use App\Models\Section;
use App\Models\User;
use App\Notifications\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact("invoices"));
    }
    public function add()
    {
        $sections = Section::all();
        return view('invoices.add', compact('sections'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'invoice_number' => 'unique:invoices,invoice_number',
            'Amount_collection'=>'min:1',
        ],[
            'invoice_number.unique'=>'رقم الفاتورة موجود بالفعل',
            'Amount_collection.min'=>'مبغ التحصيل منخفض للغاية',
        ]);
        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_date,
            'Due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section_name,
            'Discount' => $request->discount,
            'Amount_collection' => $request->amount_collection,
            'Amount_Commission' => $request->amount_commission,
            'Rate_VAT' => $request->rate_vat,
            'Value_VAT' => $request->value_vat,
            'Total' => $request->total,
            'Status' => 'غير مدفوعه',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);
        $invoice_id = Invoice::latest()->first()->id;
        invoices_details::create([
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'id_Invoice' => $invoice_id,
            'Section' => $request->section_name,
            'Status' => 'غير مدفوعه',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => auth()->user()->name,
        ]);
        if ($request->hasFile('file')) {
            $invoice_id = Invoice::latest()->first()->id;
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            invoice_attachments::create([
                'invoice_id' => $invoice_id,
                'file_name' => $file_name,
                'invoice_number' => $invoice_number,
                'Created_by' => auth()->user()->name,
            ]);
            $request->file->move(public_path('Attachments/' . $invoice_number), $file_name);
        }
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $invoice = Invoice::latest()->first();
        $user_create = auth()->user()->name;
        Notification::send($users, new invoices($invoice, $user_create));

        session()->flash('add', 'تم اضافة الفاتورة بنجاح');

        return redirect()->back();
    }

    public function details($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $details = invoices_details::all();
        $attachments = invoice_attachments::all();
        $attachment=invoice_attachments::where('id',$id)->first();
        return view('invoices.details', compact('invoice', 'details', 'attachments','attachment'));
    }

    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit', compact('invoice', 'sections'));
    }

    public function update(Request $request, $id)
    {
        DB::table('invoices')->where('id', $id)->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_date,
            'Due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section_name,
            'Discount' => $request->discount,
            'Amount_collection' => $request->amount_collection,
            'Amount_Commission' => $request->amount_commission,
            'Rate_VAT' => $request->rate_vat,
            'Value_VAT' => $request->value_vat,
            'Total' => $request->total,
            'Status' => 'غير مدفوعه',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);
        return redirect()->route('invoices');
    }

    public function delete($id)
    {
        $invoice = Invoice::onlyTrashed()->where('id', $id)->first();
        return view('invoices.delete', compact('invoice'));
    }
    public function delete_1($id)
    {
        $Invoice = Invoice::where('id', $id)->first();
        return view('invoices.delete1', compact('Invoice'));
    }
    public function archive($id)
    {
        Invoice::where('id', $id)->delete();
        session()->flash('archive', 'تم أرشفة الفاتورة بنجاح');
        return redirect()->route('invoices');
    }
    public function softDeleted()
    {
        $invoices = Invoice::onlyTrashed()->get();
        $attachment = invoice_attachments::all();
        return view('invoices.softDeleted', compact('invoices', 'attachment'));
    }
    public function restore($id)
    {
        Invoice::withTrashed()->where('id', $id)->restore();
        return redirect()->back();
    }
    public function forceDelete($id)
    {
        Invoice::where('id', $id)->forceDelete();
        $attachment = invoice_attachments::where('invoice_id', $id)->get();
        if (!empty($attachment->invoice_number)) {
            Storage::disk('public_uploads')->deleteDirectory($attachment->invoice_number);
        }
        session()->flash('force_delete', 'تم حذف الفاتورة بنجاح');
        return redirect()->route('invoice.softDeleted');
    }
    public function forceDelete_1($id)
    {
        Invoice::where('id', $id)->forceDelete();
        $attachment = invoice_attachments::where('invoice_id', $id)->get();
        if (!empty($attachment->invoice_number)) {
            Storage::disk('public_uploads')->delete($attachment->invoice_number);
        }
        session()->flash('force_delete', 'تم حذف الفاتورة بنجاح');
        return redirect()->route('invoices');
    }

    public function status($id)
    {
        $sections = Section::all();
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.status', compact('invoice', 'sections'));
    }
    public function status_update($id, Request $request)
    {
        $invoice_id = Invoice::latest()->first()->id;
        if ($request->status === 'مدفوعة') {
            DB::table('invoices')->where('id', $id)->update([
                'Value_Status' => 1,
                'Status' => $request->status,
                'Payment_Date' => $request->payment_date,
            ]);
            invoices_details::create([
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'id_Invoice' => $invoice_id,
                'Section' => $request->section_name,
                'Status' => $request->status,
                'Value_Status' => 1,
                'note' => $request->note,
                'user' => auth()->user()->name,
            ]);
        } else {
            DB::table('invoices')->where('id', $id)->update([
                'Value_Status' => 3,
                'Status' => $request->status,
                'Payment_Date' => $request->payment_date,
            ]);
            invoices_details::create([
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'id_Invoice' => $invoice_id,
                'Section' => $request->section_name,
                'Status' => $request->status,
                'Value_Status' => 3,
                'note' => $request->note,
                'user' => auth()->user()->name,
            ]);
        }
        session()->flash('update_status', 'تم تعديل حالة الدفع للفاتورة بنجاح');
        return redirect()->route('invoices');
    }

    public function showInvoice($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.show_to_print', compact('invoice'));
    }


    public function paid_invoices()
    {
        DB::table('invoices')->where('Value_Status', 1)->update([
            'Status' => 'مدفوعة',
        ]);
        $paid = Invoice::where('Value_Status', 1)->get();
        return view('invoices.paid', compact('paid'));
    }
    public function unpaid_invoices()
    {
        $upaid = Invoice::where('Value_Status', 2)->get();
        return view('invoices.unpaid', compact('upaid'));
    }
    public function spaid_invoices()
    {
        DB::table('invoices')->where('Value_Status', 3)->update([
            'Status' => "مدفوعة جزئيا",
        ]);
        $spaid = Invoice::where('Value_Status', 3)->get();
        return view('invoices.spaid', compact('spaid'));
    }
    public function getproducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }

    public function markAsRead()
    {
        if (auth()->user()->unreadNotifications) {
            auth()->user()->unreadNotifications->markAsRead();
        }
        return redirect()->back();
    }
    public function details_notify($id)
    {
        $user = User::where('id', auth()->user()->id)->first();
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        $invoice = Invoice::where('id', $id)->first();
        $details = invoices_details::all();
        $attachments = invoice_attachments::all();
        return view('invoices.details', compact('invoice', 'details', 'attachments'));
    }
}
