<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'timestamp',
        'total_amount',
        'total_profit',
        'total_amount_with_discount',
        'updated_at',
        'created_at',
        'discount',
        'amount_received',
        'change'
    ];

    public function orders()
    {
        return $this->hasMany(OrderModel::class ,'transaction_id');
    }

    public function user()
    {
        return $this->hasOne(User::class ,'id','user_id');
    }

   /**
     * Get all Transaction
     *
     * @return collection
     */
    public function getAllTransaction(){
        DB::statement("SET SQL_MODE=''");
        $data = $this::select(
                              DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date"),
                              DB::raw("SUM(total_amount) as total_amount"),
                              DB::raw("SUM(total_profit) * -1 as total_profit")
        )
        ->groupBy('formatted_date')
        ->get();

        return $data;
    }

    /**
     * Filter Transaction
     *
     * @return collection
     */
    public function FilterTransaction(Request $request){

        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');
        $toDate = Carbon::parse($toDate)->endOfDay();
        DB::statement("SET SQL_MODE=''");
        $data = $this::select(
                          DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date"),
                          DB::raw("SUM(total_amount) as total_amount"),
                          DB::raw("SUM(total_profit) * -1 as total_profit")
        )
        ->whereDate('created_at', '>=', $fromDate)
        ->whereDate('created_at', '<=', $toDate)
        ->groupBy('formatted_date')
        ->get();
        return $data;
    }

    /**
     * Bar Graph Monthly Sales 
     *
     * @return collection
     */
    public function GetMonthlySales(){

        DB::statement("SET SQL_MODE=''");
            $currentYear = date('Y');
            $monthlySales = $this::select(
                            DB::raw("MONTH(created_at) as month"),
                            DB::raw("SUM(total_amount_with_discount) as total_amount")
            )
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->get();
        return $monthlySales;
    }

    /**
     * Monthly Sales 
     *
     * @return collection
     */
    public function getCurrentMonthSales(){

        DB::statement("SET SQL_MODE=''");
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        return $this->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->sum('total_amount_with_discount');
    }
    /**
     * Monthly profit 
     *
     * @return collection
     */
    public function getCurrentMonthProfit(){

        DB::statement("SET SQL_MODE=''");
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        return $this->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->sum('total_profit') * -1;
    }
}
