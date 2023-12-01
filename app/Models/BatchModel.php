<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchModel extends Model
{
    use HasFactory;
    protected $table ='batch';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'updated_at',
        'created_at',
    ];

    public function getLastbatch(){
        return $this::latest('id')->first();
    }

    
}
