<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    public $timestamps = false; 
    protected $fillable=[
        'order_id','item_id','purchase_quantity'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
