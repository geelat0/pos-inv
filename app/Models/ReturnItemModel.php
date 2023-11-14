<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItemModel extends Model
{
    use HasFactory;
    protected $table ='return_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_id',
        'user_id',
        'transaction_id',
        'return_ground_id',
        'status',
        'purchase_date',
        'return_date',
    ];
}
