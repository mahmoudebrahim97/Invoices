<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoicesResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class InvoiceController extends Controller
{
    use apiResponseTrait   ;
    public function index(){
        $invoices=InvoicesResource::collection(Invoice::get());
        return $this->apiResponseTrait($invoices,'response success',200);
    }
    public function add(){
        $invoices=InvoicesResource::collection(Invoice::get());
        return $this->apiResponseTrait($invoices,'response success',200);
    }
    public function details($id){
        $invoice= Invoice::where('id', $id)->first();
        if($invoice){
            return $this->apiResponseTrait(new InvoicesResource($invoice),'response success',200);
        }else{
            return $this->apiResponseTrait(null,'response failed',404);
        }
    }
    public function insert(Request $request){
        $invoice=Invoice::create([
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
        if($invoice){
            return $this->apiResponseTrait(new InvoicesResource($invoice),'insert invoice success',200);
        }else{
            return $this->apiResponseTrait(null,'response failed',404);
        }
    }

}
