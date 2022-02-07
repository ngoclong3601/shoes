<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Response;
use Mail;
use App\Mail\Gmail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Session;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add(Request $request,$id){
        
        // $product_id = Product::find( $id);
        // $product_id = Request::get('product_id');
        // dd($product);
        $size = $request->input('size');
      
        // dd($size);

        $product = DB::table('products')->join('product_size', 'products.id', '=', 'product_size.product_id')
        ->join('size','product_size.size_id', '=' ,'size.id')
        ->select('products.id', 'products.product_name','products.price','products.image'
            ,'size.name_size', 'product_size.size_id'
        )->where('products.id' ,$id)->where('size.name_size', $size)->first();
    

        // dd($product);

        Cart::add(array(

                'id' => $product->id,
                'name'=> $product->product_name,
                'price'=> $product->price,
                'qty' => $request->input('quantity'),
                'options'=>['image' => $product->image, 'size' =>$product->name_size, 'size_id' => $product->size_id]
                
        ));

    
        $cart = Cart::content();
        $count = Cart::count();
        $data = (object) [
            'selectedProductName' => $product->product_name,
            'count' => $count
        ];
        // return Response::json($data);
        
        return redirect(route('frontend.cart.view'));

    }
   
   

    public function viewcart()
    {
        $cart = Cart::content();
        // dd($cart);
        return view('frontend.cart', array('cart' => $cart));
        
        
    } 
   

    public function increaseQty($id){

        $cartRow = Cart::search(function ($cartItem, $rowId) use ($id) {

            if ($cartItem->id == $id) {
                return $cartItem->name;
            }
        });
        
        $cartRow = $cartRow->first();
        if ($cartRow == null) {

            $product_id = $id;

            $product = DB::table('products')->where('id', '=', $product_id)->get();
            $product = $product[0];
            Cart::add(array(
                'id' => $product_id,
                'name'=> $product->product_name,
                'price'=> $product->price,
                'qty' => 1,
                'options'=>['image' => $product->image,  'size'=> $product->size,],
                
            ));
           
        }else{
            $rowId = $cartRow->rowId;

            $product = Cart::get($rowId);

            Cart::update($rowId, $product->qty + 1);

            $result = [
                'id' => $cartRow->id,
                'name' => $cartRow->name,
                'price' => $cartRow->price,
                'qty' => $cartRow->qty,
                'totalItem' => $cartRow->totalItem,
                'subtotal' => Cart::subtotal(),
                'count' => Cart::count(),
                'image' => $cartRow->options->image,
                'size' => $cartRow->options->size,
            ];
    
            return $result;
        }
        
    }
    public function decreaseQty($id){
        
        $cartRow = Cart::search(function ($cartItem, $rowId) use ($id) {

            if ($cartItem->id == $id) {
                return $cartItem->name;
            }
        });

        $cartRow = $cartRow->first();
        if( $cartRow->qty > 1 ){
            
            $rowId = $cartRow->rowId;

            $product = Cart::get($rowId);

            Cart::update($rowId, $product->qty - 1);

            $result = [
                'id' => $cartRow->id,
                'name' => $cartRow->name,
                'price' => $cartRow->price,
                'qty' => $cartRow->qty,
                'totalItem' => $cartRow->totalItem,
                'subtotal' => Cart::subtotal(),
                'count' => Cart::count(),
                'image' => $cartRow->options->image,
                'size' => $cartRow->options->size,
            ];
            return $result;
        }else{
            return false;
        }

    }

    public function remove($id){

        $cartRow = Cart::search(function($cartItem, $rowId) use ($id){
            if($cartItem->rowId == $id){
                return $cartItem->name;
            }
        });
        $cartRow = $cartRow->first();

        $rowId = $cartRow->rowId;
        
        Cart::get($rowId);
        Cart::remove($rowId);
        return redirect(route('frontend.cart.view'));
    }

    
    public function pay(){
        $cart = Cart::content();
        $payment = [
            [ 'payment'=>'Nhận hàng trả tiền','value' => '1'],
            [ 'payment'=>'Chuyển khoản','value' => '2']

        ];

        return view('frontend.pay',array('cart' => $cart));
    }

    public function confirm_pay(Request $request){

        $cart = Session::get('cart');

        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->totalMoney = Cart::subtotal();
        $order->Date = date('Y-m-d');
        $order->delivery_address = $request->input('delivery_address');
        $order->status = 'chưa xác nhận';
        $order->payment = $request->input('payment');
        $order->save();


        foreach ($cart as $key => $value['items']) {
            foreach($value['items'] as $key=>$v)
            {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $v->id;
                $order_detail->product_name = $v->name;
                $order_detail->product_price = $v->price;
                $order_detail->qty = $v->qty;
                $order_detail->size = $v->options->size;
                $order_detail->subtotal = $v->subtotal;
                $order_detail->save();

              
                $product_size = DB::table('product_size')
                ->select('quantity')
                ->where('product_size.product_id', $v->id)->where('product_size.size_id', $v->options->size_id)->first();

                $productQty = $product_size->quantity - $v->qty;
                $product_size->quantity = $productQty;
                
                $data = json_encode($product_size->quantity);

                $update = DB::table('product_size')
                ->where('product_size.product_id', $v->id)
                ->where('product_size.size_id', $v->options->size_id)->update(['quantity' => $data]);

            }
        }
        
 
        // Mail::send('mail.gmail',['cart'=>$cart,'order'=>$order], function($msg) use ($order){
        //     $cart = Cart::content();
        //     $msg->from('prolavip906@gmail.com', 'LK');
        //     $msg->to(auth()->user()->email)->subject('HÓA ĐƠN BÁN HÀNG');
        // });
      
            
        
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');
        
    }
    public function send(){

        $data = [
            'title' => 'asdfasd',
            'body' => 'sddgadga',
        ];

        Mail::to("prolavip906@gmail.com")->send(new Gmail($data));
       
    }
  

    

}
