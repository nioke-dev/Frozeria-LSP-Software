<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'stock',
        'unit',
        'buy_price',
        'sell_price',
        'min_stock',
        'weight',
        'storage_location',
        'description',
        'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope untuk stok menipis (kurang dari min_stock/20)
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<', 'min_stock')->where('stock', '>', 0);
    }

    // Scope untuk stok habis (0)
    public function scopeOutOfStock($query)
    {
        return $query->where('stock', '<=', 0);
    }
}
