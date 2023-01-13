<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopList extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_name',
        'list_description',
        'user_id'

    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(Item::class, 'shoplist_id'); 
    }

    

}
