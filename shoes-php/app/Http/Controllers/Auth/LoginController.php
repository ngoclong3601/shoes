<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index(){
        return view('auth.login');
    }
    
    public function postLogin(Request $request){
       
        $rules = [
            'email' =>'required|email',

        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
      
        $credentials = [
            'email'=> $request->email,
            'password' => $request->password,
            'is_verified' => 1
        ];
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }else{
            
            if(Auth::attempt($credentials)){
                
                $cart = Session::get('Cart');
                $level = Auth::user()->level;

                if($level == 1){
                    return redirect()->route('index_product')->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
                }
                else{
                    
                    if ( $level == 2 && Cart::count() >  0){
                   
                        return redirect()->route('frontend.cart.pay');
                    }
                    else{
                        return redirect('/');
                    }
                 
                }
                
            }
            else{
                Session::flash('error', 'Email hoặc mật khẩu không đúng!');
                return redirect()->route('admin.login');
            }
        }
       
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
