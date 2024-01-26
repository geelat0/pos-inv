<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sched extends Model
{
    use HasFactory;

    protected $table ="schedule";


    protected $primaryKey="sched_id";
    protected $fillable = [
        'user_id',
        'sched_1',
        'sched_2',
        'sched_3',
        'sched_4',
        'sched_5',
        'sched_6',
        'sched_7',
        'update_at',
        'created_at',
    ];
}
