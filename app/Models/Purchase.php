<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'category_id',
        'supplier_id',
        'ref',
        'name',
        'sku',
        'created_by',
        'price',
        'discount_price',
        'shipping_cost',
        'grand_total',
        'quantity',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
