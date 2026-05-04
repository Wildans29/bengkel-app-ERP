<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'estimation_id',
        'invoice_no',
        'date',
        'total',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function estimation()
    {
        return $this->belongsTo(Estimation::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'bill_invoices');
    }

}
