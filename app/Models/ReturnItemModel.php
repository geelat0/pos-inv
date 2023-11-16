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
        'id',
        'item_id',
        'user_id',
        'transaction_id',
        'return_ground',
        'status',
        'purchase_date',
        'return_date',
    ];

    public function item()
    {
        return $this->belongsTo(ItemModel::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
