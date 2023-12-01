<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getActiveItem()
    {
        DB::statement("SET SQL_MODE=''");
        return $this::where('status', 'Active')->groupby('name')->get();
    }
    public function queryItem(Request $request)
    {
        $query = $request->get('query');
        DB::statement("SET SQL_MODE=''");
        return $this::where('name', 'like', "%$query%")
                            ->where('status', 'Active')
                            ->groupby('name')
                            ->get();
    }
    
}
