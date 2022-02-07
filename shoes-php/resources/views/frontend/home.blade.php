@extends('layouts.app')
@section('content')
<section>
    <div class="row" >
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
                <div class="head">Browse Categories</div>
                <ul class="main-categories">
                    @foreach ($categories as $cate)
                    <div class="li-shoes">
                        <li><a href="{{ route('frontend.category.show',['id'=>$cate->id]) }}">{{$cate->name}}</a></li>
                    </div>
                    @endforeach     
                </ul>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 col-md-7">
            <div class="row">
                @foreach ($product as $pro)
                    <div class="col-lg-4 col-md-6">
                        <div>
                            <div class="img-div">
                                <img class="img-product " src="{{ asset('assets/img/portfolio/' .$pro->image )}}" alt="" data-pagespeed-url-hash="3348146026" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" >
                                <div class="overlay">
                                    <a href="#" class="icon-cart">
                                        <i class="fas fa-shopping-cart" ></i>
                                    </a>
                                    <a href="{{route('frontend.productdetail', ['id'=>$pro->id])}}" class="icon-search-detail">
                                        <i class="fas fa-search" ></i>
                                    </a>
                                </div>
                            </div>
                            
                            
                                <div class="product-details">
                                    <h6>{{ $pro -> product_name}}</h6>
                                    <div >
                                        <h6>{{number_format($pro->price,0 )}}</h6>
                                    </div>
                                </div>
                         </div>
                     </div>
                @endforeach    
                </div>
            </div>
    </div>
</section>


@endsection