<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;
use OrderDetail;

class Order extends Model
{
    protected $fillable = [
    	'user_id',
    	'totalMoney',
    	'Date',
        'delivery_address',
        'status',
        'payment'
    ];
    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
}
