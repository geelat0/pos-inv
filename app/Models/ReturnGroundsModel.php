<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnGroundsModel extends Model
{
    use HasFactory;
    protected $table ='return_grounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'desc',
        'updated_at',
        'created_at',
    ];
}
