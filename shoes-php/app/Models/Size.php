<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Product;

class Size extends Model
{
    public $table = "size";

    protected $fillable = [
    	'name_size',
        'quantity'
    ];
    public function product(){
        return $this->belongsToMany(Product::class,'product_size','product_id','size_id');
    }
}
