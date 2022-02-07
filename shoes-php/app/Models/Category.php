<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $fillable = [
    	'name',
    	'keywords'
    ];
    public function products()
    {
    	return $this->hasMany(Product::class,'category_id','id');
    }
}
