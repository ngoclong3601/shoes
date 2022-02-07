@extends('layouts.app')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="title-cart">
            <h1>GIỎ HÀNG</h1>
        </div>
        <div class="row" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive">
                    <div  class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
                    @if(count($cart))
                        <table  class="table m-0"  style="text-align:center">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th></th>
                                    <th>Giá</th>
                                    <th>Kích cỡ</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                        @foreach($cart as $item)
                        <tr class="rem1">
                                <td class="invert-image">
                                    <a href="#">
                                        <img style="height:auto; width:auto; max-width:250px; max-height:100px;"
                                        @if ($item->options && $item->options->image)
                                            src="{{asset('assets/img/portfolio/' .$item->options->image) }}"
                                        @else
                                            src='#'
                                        />
                                        @endif
                                    </a>
                                </td>
                                <td class="invert" style="position:relative; padding-top:50px;">
                                      {{$item->product_name}}
                                </td>
                                <td class="invert" id="price-{{$item->id}}" style="position:relative; padding-top:50px;">{{number_format($item->price,0)}} VND</td>
                                <td class="invert" style="position:relative; padding-top:50px;">
                                     {{$item->options->size}}
                                </td>
                               
                                <td style="position: relative; padding-top:50px; ">
                                    <div class="quan_cart">
                                        <button onclick="increaseItem({{$item->id}})" class="increase items-count" type="button" >
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                        <input type="text" name="qty" id="qty-{{$item->id}}" maxlength="12" value="{{$item->qty}}" title="Quantity:" class="input-text qty">
                                        <button onclick="decreaseItem({{$item->id}})" class="reduced items-count" type="button">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </td>
                                <td  style="position:relative; padding-top:50px;" id="totalItem-{{$item->id}}">
                                        {{ number_format($item->price * $item->qty)}}
                                </td>
                                <td>
                                    <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5" id="remove-cart" href="{{route('frontend.cart.remove', ['id'=>$item->rowId])}}" style="position:relative; top:30px;"   >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                        <tfoot >
					        <tr >
						        <th colspan="4">Tổng cộng</th>
                                <th id="bill-total"> {{ Cart::subtotal() }} VND</th>
                                <th></th>
				            </tr>
				        </tfoot>  
                  </table>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        <div style="margin-top: 20px;" class="row">
            <div class="col" >
                <a style="margin-left:40px; float:left;" href="{{route('frontend.home')}}" class="btn btn-outline-secondary">Mua hàng</a>
                
            </div>
            <div class="col">
                <a style="float:right;" type="button" class="btn btn-success" href="{{route('frontend.cart.pay')}}">Thanh toán</a>
                
            </div>
        </div>
      </div>
    </section>

@endsection