<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table ='supplier';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supplier_name',
        'email',
        'contact_no',
        'updated_at',
        'status',
        'created_at',
    ];

    public function items()
    {
        return $this->hasMany(ItemModel::class);
    }
}
