<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    public $timestamps = false; 
    protected $fillable=[
        'category_item_name'
    ];
    public function item(){
        return $this->hasMany(Item::class,'category_item_id');
    }
}
