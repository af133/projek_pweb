<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //  Schema::create('items', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('item_name');
    //         $table->integer('stok');
    //         $table->string('path_item')->nullable();
    //         $table->foreignId('category_item_id')->constrained('category_items')->onDelete('cascade');
    //         $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    //     });
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
