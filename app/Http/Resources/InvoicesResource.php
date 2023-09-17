<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'invoice_number'=>$this->invoice_number,
            'invoice_Date'=>$this->invoice_Date,
            'Due_date'=>$this->Due_date,
            'product'=>$this->product,
            'section_id'=>$this->section_id,
            'Discount'=>$this->Discount,
            'Rate_VAT'=>$this->Rate_VAT,
            'Value_VAT'=>$this->Value_VAT,
            'Amount_collection'=>$this->Amount_collection,
            'Amount_Commission'=>$this->Amount_Commission,
            'Total'=>$this->Total,
            'Status'=>$this->Status,
            'Value_Status'=>$this->Value_Status,
            'note'=>$this->note,
        ];
    }
}
