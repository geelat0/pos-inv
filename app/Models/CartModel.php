<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $table ="cart";

    protected $fillable = [
        'item_id',
        'amount',
        'quantity'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(ItemModel::class);
    }
}
