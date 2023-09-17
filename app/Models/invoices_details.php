<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;
    protected $fillable=[
        'invoice_number',
        'product',
        'id_Invoice',
        'Section',
        'Status',
        'Value_Status',
        'note',
        'user',
    ];
}
