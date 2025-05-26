<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $fillable=[
        'order_id','item_id','purchase_quantity'
    ];
    public function order(){
        return $this->hasMany(Order::class,'order_id');
    }
    public function item(){
        return $this->hasMany(Item::class,'item_id');
    }
}
