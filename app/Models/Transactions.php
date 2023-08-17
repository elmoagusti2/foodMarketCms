<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillabe = [
        'food_id', 'user_id', 'total', 'status', 'payment_url',
    ];

    public function food(){
        return $this->hasOne(Food::class, 'id', 'food_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }
}
