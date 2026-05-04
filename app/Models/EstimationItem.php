<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstimationItem extends Model
{
    protected $fillable = [
        'estimation_id',
        'type',
        'item_id',
        'qty',
        'price',
        'subtotal'
    ];

    public function estimation()
    {
        return $this->belongsTo(Estimation::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
