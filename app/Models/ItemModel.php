<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $table ='item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'supplier_price',
        'selling_price',
        'no_of_stocks',
        'replenish',
        'status',
        'updated_at',
        'created_at',
        'category_id',
        'supplier_id',
        
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class);
    }

    public function batchOrder()
    {
        return $this->belongsTo(BatchOrderModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
