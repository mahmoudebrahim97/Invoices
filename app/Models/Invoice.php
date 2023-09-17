<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
    'invoice_number',
    'invoice_Date',
    'Due_date',
    'product',
    'section_id',
    'Discount',
    'Rate_VAT',
    'Value_VAT',
    'Amount_collection',
    'Amount_Commission',
    'Total',
    'Status',
    'Value_Status',
    'note',
    ];

    use SoftDeletes ;

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
