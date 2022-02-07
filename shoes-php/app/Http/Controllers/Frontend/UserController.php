<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        return view('frontend.user');
    }
    public function update_user(Request $request){

        $userId = Auth::id();
        $user = User::findOrFail($userId);
        
        $user->update([

            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);
        $user->save();

        return redirect(route('frontend.user'))->with('status', 'Cập nhật thành công');
        
    }
}
