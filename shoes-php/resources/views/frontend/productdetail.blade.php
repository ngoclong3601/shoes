@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @foreach ($productDetail as $proDetail)
                
                <div class="col">
                    <img style="width:500px;" src="{{asset('assets/img/portfolio/' .$proDetail->image)}}" name="image" alt="">
                </div>
                <div class="col-lg-5 offset-lg-1">
                <form action="{{route('frontend.cart.add',['id'=> $proDetail->id])}}" method="post">
                     @csrf
                   
                    <div class="product-text">
                        <h3>{{$proDetail->product_name}}</h3>
                        <h2>{{number_format($proDetail -> price,0)}} VND</h2>
                        
                        <!-- <div id="size-product"  class="list">
                            <label for="size" style="font-size: 14px;color: #777;font-weight: normal;
                                padding-right: 10px;">Kích thước</label>
                            <span class="css-size-product active" name="size" data-size="39">39</span>
                            <span class="css-size-product " name="size" data-size="40">40</span>
                            <span class="css-size-product "  name="size" data-size="41">41</span>
                            <span class="css-size-product "  name="size" data-size="42">42</span>
                            <span class="css-size-product " name="size" data-size="43">43</span>
                        </div> -->
                       

                        <ul class="list">
                            <li>
                                <span>Size:</span>
                                <select  name="size">
                                    @foreach ($product_size as $s )
                                    @if ($s->quantity == 0 )
                                        <option disabled value="{{$s->name_size}}">{{$s->name_size}}</option>
                                    @else
                                        <option value="{{$s->name_size}}">{{$s->name_size}}</option>
                                    @endif
                                    @endforeach
                                </select> 
                            </li>
                        </ul>
                        <hr>   
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                <i class="fas fa-chevron-up"></i>
                            </button>
                            <input type="text" name="quantity" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div style="align-items:center !important;" class="card_area d-flex align-items-center">
                            <button  class="primary-btn" type="submit"  aria-disabled="false" > Add to cart </button>
                            <!-- <a  class="primary-btn"  href="" >Add to cart</a> -->
                            <a  class="primary-btn"  href="{{route('frontend.cart.view')}}" >View cart</a>
                        </div>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
       let spans = document.querySelectorAll('span');
       spans.forEach(span => {
           span.addEventListener('click',function(){
               spans.forEach(s=> s.classList.remove('active'));
               this.classList.add('active');
               
           });
       });
    
    </script>
    <script src="{{ asset('js/cart.js')}}"></script>
       
@endsection