<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function SupplierExist(Request $request){

        // Validate request data
        $request->validate([
        'supplier_name' => 'required|string',
        'email' => 'required|email',
        'contact_no' => 'required|string',
        ]);
 
        $data = $this::where('supplier_name', $request->input('supplier_name'))
        ->where('email', $request->input('email'))
        ->where('contact_no', $request->input('contact_no'))
        ->first();

        return $data;
    }

    public function getActiveSupplier(){
        return $this::where('status', 'Active')->get();
    }
}
