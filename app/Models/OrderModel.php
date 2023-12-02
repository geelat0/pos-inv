<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $fillable =[
        'transaction_id',
        'item_id',
        'quantity',
        'amount',
        'profit'
    ];


    public function item()
    {
        return $this->hasOne(ItemModel::class ,'id', 'item_id');
    }

    public function to_item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
