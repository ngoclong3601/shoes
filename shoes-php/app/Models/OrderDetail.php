<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Order;
use Product;
class OrderDetail extends Model
{
    protected $fillable = [
    	'order_id',
    	'product_id',
    	'product_name',
    	'product_price',
    	'qty',
    	'size',
		'subtotal'
    ];
    public function order(){
    	return $this->belongsTo(Order::class);
    }
    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
