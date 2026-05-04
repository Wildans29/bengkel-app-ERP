<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'bill_no',
        'customer_id',
        'date',
        'total',
        'status'
    ];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'bill_invoices');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
