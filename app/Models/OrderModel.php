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

    /**
     * Get all Transaction
     *
     * @return collection
     */
    public function getAllTransaction(){
        DB::statement("SET SQL_MODE=''");
        $data = TransactionModel::select(
                              DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date"),
                              DB::raw("SUM(total_amount) as total_amount"),
                              DB::raw("SUM(total_profit) * -1 as total_profit")
        )
        ->groupBy('formatted_date')
        ->get();

        return $data;
    }
}
