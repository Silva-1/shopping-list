<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_store',
        'item_quantity',
        'shoplist_id'
        

    ];

    public function shoplist() {
        return $this->belongsTo(ShopList::class);
    }
}
