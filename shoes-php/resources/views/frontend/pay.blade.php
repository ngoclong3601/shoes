@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Shoes</h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{route('frontend.cart.view')}}" class="breadcrumb-item">Giỏ hàng</a>
                        </li>
                        > 
                        <li class="breadcrumb-item" style="margin-top:2px;">
                            <p>   Phương thức thanh toán</p>
                        </li>
                    </ul>
                    <div>
                        <h2 style="font-size: 1.28571em; font-weight: normal;
                            color: #333333;">Thông tin giao hàng</h2>
                    </div>
                    <div style="margin-top:20px;">
                        <form action="{{route('frontend.cart.confirm_pay')}}" method="post">
                        @csrf
                        <div>
                            <label for="name">Họ và tên</label>
                            <input value="{{auth()->user()->name}}"  type="text" class="form-control" placeholder="Họ và tên"  >
                        </div>
                        <div  >
                            <label  style="margin-top:20px;" for="email">Email</label>
                            <input value="{{auth()->user()->email}}" name="email"  type="text" class="form-control" placeholder="Email">
                        </div>
                        <div  >
                            <label style="margin-top:20px;" for="phone">Số điện thoại</label>
                            <input value="{{auth()->user()->phone}}"  type="text" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div  >
                            <label style="margin-top:20px;" for="address">Địa chỉ nhận hàng</label>
                            <input name="delivery_address" type="text" class="form-control " placeholder="Địa chỉ nhận hàng">
                        </div>
                        <div style="margin-top:20px;">
                            <p>Hình thức thanh toán</p>
                            <div class="row" >
                              
                                <div class="col">
                                    <input  type="radio"  name="payment" value="1" checked>
                                    <label for="age1">Nhận hàng trả tiền</label><br>
                                </div>
                            
                                <div class="col">
                                    <input  type="radio" name="payment" value="2">
                                    <label >Chuyển khoản</label><br>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:20px;">
                            <div class="row" >
                                <div class="col">
                                        <a class="btn btn-outline-secondary" href="{{route('frontend.cart.view')}}" style="text-decoration: none">Giỏ hàng</a>
                                </div>
                                <div class="col">
                                        <button try="submit" class="btn btn-outline-secondary">Xác nhận đặt hàng</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div style="background-color:#F5F5F5;box-shadow: 1px 0 0 #e1e1e1 inset;" class="col">
                    <div class="container">
                    @if(Cart::count() > 0 )
                    @foreach($cart as $item)
                        <div style="margin-top:50px;"class="row">
                            <div  class="col-3">
                                <img style="  max-height:75px;"
                                    @if($item->options && $item->options->image)
                                    src="{{asset('assets/img/portfolio/' .$item->options->image)}}"
                                    @else
                                    src='#'
                                    @endif 
                                    alt=""/>
                                </div>
                            <div class="col-9">
                                <div>{{$item->name}}</div>
                                <div class="viewcart-size">{{$item->options->size}}</div>
                                <span class="viewcart-quantity">{{$item->qty}}</span>
                                <span class="viewcart-price">{{number_format($item->subtotal) }} VND</span>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        <div class="row">
                            <div class="col-3">
                                Tổng cộng:
                            </div>
                            <div class="col-9" >
                                <span style="float:right;">{{ Cart::subtotal() }} VND</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
      
    </section>
@endsection