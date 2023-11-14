<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchOrderModel extends Model
{
    use HasFactory;
    protected $table = 'batch_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'batch_id',
        'supplier_id',
        'category_id',
        'item_id',
        'replenish',
        'qty',
        'supplier_price',
        'total',
        'updated_at',
        'created_at',
    ];

    public function batch()
    {
        return $this->belongsTo(BatchModel::class);
    }

    public function item()
    {
        return $this->belongsTo(ItemModel::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class);
    }

}
