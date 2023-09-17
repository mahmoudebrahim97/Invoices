<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function reports()
    {
        return view("reports.invoice_reports");
    }
    public function invoices_search(Request $request)
    {
        $radio = $request->radio;
        // في حالة البحث بدون التاريخ
        if ($radio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {
                if ($request->type == 'مدفوعة') {
                    $invoices = Invoice::where('Value_Status', 1)->get();
                    $type = $request->type;
                    return view('reports.invoice_reports1', compact('type', 'invoices'));
                } elseif ($request->type == 'غير مدفوعه') {
                    $invoices = Invoice::where('Value_Status', 2)->get();
                    $type = $request->type;
                    return view('reports.invoice_reports1', compact('type', 'invoices'));
                } elseif ($request->type == 'مدفوعة جزئبا') {
                    $invoices = Invoice::where('Value_Status', 3)->get();
                    $type = $request->type;
                    return view('reports.invoice_reports1', compact('type', 'invoices'));
                } else {
                    session()->flash('notFound', 'الفاتورة غير موجوده');
                    return view('reports.invoice_reports');
                }
            } elseif ($request->type && $request->start_at && $request->end_at) {
                if ($request->type == 'مدفوعة') {
                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $type = $request->type;
                    $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Value_Status', 1)->get();
                    return view('reports.invoice_reports', compact('type', 'start_at', 'end_at', 'invoices'));
                } elseif ($request->type == 'غير مدفوعه') {
                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $type = $request->type;
                    $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Value_Status', 2)->get();
                    return view('reports.invoice_reports', compact('type', 'start_at', 'end_at', 'invoices'));
                } elseif ($request->type == 'مدفوعة جزئبا') {
                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $type = $request->type;
                    $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Value_Status', 3)->get();
                    return view('reports.invoice_reports', compact('type', 'start_at', 'end_at', 'invoices'));
                } else {
                    session()->flash('notFound', 'الفاتورة غير موجوده');
                    return view('reports.invoice_reports');
                }
            } else {
                session()->flash('notFound', ' يرجي ادخال التاريخ  ');
                return view('reports.invoice_reports');
            }
            // في حالة البحث بتاريخ
        } else {
            $invoices = Invoice::where('invoice_number', $request->invoice_number)->get();
            return view('reports.invoice_reports', compact('invoices'));
        }
    }
    public function customers()
    {
        $sections = Section::all();
        return view('reports.customers', compact('sections'));
    }
    public function customers_search(Request $request)
    {
        // في حالة البحث بدون التاريخ
        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = Invoice::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = Section::all();
            return view('reports.customers', compact('sections', 'invoices'));
        }
        // في حالة البحث بتاريخ
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = Section::all();
            return view('reports.customers', compact('sections', 'invoices'));
        }
    }
}
