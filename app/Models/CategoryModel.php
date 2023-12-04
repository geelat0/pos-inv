<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table ='category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'updated_at',
        'status',
        'created_at',
    ];
    
    public function getActiveCat()
    {
        return $this::where('status', 'Active')->get();
    }
    
    public function queryItem(Request $request)
    {
        $query = $request->get('query');
        DB::statement("SET SQL_MODE=''");
        return $this::where('category_name', 'like', "%$query%")
                            ->where('status', 'Active')
                            ->groupby('category_name')
                            ->get();
    }   
}
