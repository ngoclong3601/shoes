<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
class AdminController extends Controller
{
    public function index_product(){

        $list_product = DB::table('products')->join('product_size', 'products.id', '=', 'product_size.product_id')
        ->join('size','product_size.size_id', '=' ,'size.id')
        ->select('products.id', 'products.product_name','products.price','products.image'
            ,'size.name_size', 'product_size.size_id', 'product_size.quantity')->get();
        // dd($list_product);
        return view('admin.dashboard')->with([
            'list_product' => $list_product
        ]);
        
    }

    public function add_product(){
        return view('admin.addproduct');
    }
}
