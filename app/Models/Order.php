<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; 
    protected $fillable=[
        'user_id','order_date'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function detail_order(){
        return $this->hasMany(DetailOrder::class,'order_id');
    }
}
