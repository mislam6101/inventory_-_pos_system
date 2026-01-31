<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'common_id',
        'c_name',
        'cont',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
