<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function index(){
        $categories = Category::all();
        // dd($productsList);
        $productsList = Category::join('products','categories.id','=','products.category_id')->paginate(6);
    
        return view('frontend.home')->with([
            'product' => $productsList,
            'categories' => $categories
        ]);
   
    }

    public function show($id){
        $category = Category::find($id);
        if(!$category) {
            abort(404);
        }
        $categories = Category::all();
        $products = Product::where('category_id', $id)->paginate(6);
        return view('frontend.home')->with([
            'categories' => $categories,
            'product' => $products
        ]);
    }
    public function productDetail($id){

        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $category_Detail = Category::select('name')->join('products', 'categories.id', '=' ,'category_id')
        ->where('products.id','=',  $id)->get();

        $product_Detail = Product::where('id','=',$id)->get();

        
        
        $product_size = DB::table('product_size')
            ->join('size', 'product_size.size_id', '=', 'size.id')
            ->select('quantity','name_size','size_id')
            ->where('product_size.product_id', $id)->get();
           
        // $product_Detail = Product::where('product_name', $name)->get();
        return view('frontend.productdetail')->with([
            'category' => $category_Detail,
            'productDetail' => $product_Detail,
            'product_size' => $product_size
        ]);
    }
    public function searchProduct(Request $request) {
        $categories = Category::all();
        
        $productsList = Category::join('products','categories.id','=','products.category_id')->paginate(6);

        $search = $request->input('searchText');
        $products = DB::table('products')->select('*')
        ->where('product_name', 'like', '%' . $search . '%')->get();
    
        return view('frontend.home')->with([
            'product' => $products,
            'categories' => $categories
        ]);
    }
}
