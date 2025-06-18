<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false; 
    protected $fillable=[
        'item_name','stok','price','path_item','category_item_id','user_id'
    ];
    public function category(){
        return $this->belongsTo(CategoryItem::class,'category_item_id');
    }
    public function detail_order(){
        return $this->belongsTo(DetailOrder::class,'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
