<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Category;
use Size;
use ProductImg;
use OrderDetail;

class Product extends Model
{
    protected $fillable = [
    	'product_name',
    	'prkeywords',
    	'image',
    	'price',
    	'category_id',
        'qty_nhap',
        'size'
    ];
 
    public function category(){
    	return $this->belongsTo(Category::class);
    }
    public function productImgs(){
        return $this->hasMany(ProductImg::class,'product_id','id');
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'product_id','id');
    }
    public function size(){
        return $this->belongsToMany(Size::class,'product_size','size_id','product_id');
    }
}
