<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'margin',
        'cost',
        'sellingprice'
    ];
    public function sale()
    {
        return $this->hasOne(Sale::class);
    }
}
