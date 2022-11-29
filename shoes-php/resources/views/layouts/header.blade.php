<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="icon" type="image/x-icon" href="{{   asset('assets/favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    
</head>
<body  id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{route ('frontend.home')}}">Cửa hàng</a></li>
                        @if(Auth::check())
                        <li class="nav-item">
                            <div class="dropdown show">
                                <a class="btn dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Chào bạn {{Auth::user()->name}}
                                </a>
                                @if(Auth::user()->level == 1)
                                <div style="background-color:#212529;" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a style="color:gray;" class="dropdown-item" href="{{route('index_product')}}">Quản lý bán hàng</a>
                                    <a style="color:gray;" class="dropdown-item" href="{{route('frontend.user')}}">Thông tin tài khoản</a>
                                    <a  style="color:gray;" class="dropdown-item" href="{{route('admin.logout')}}">Đăng xuất</a>
                                </div>
                                @else
                                <div style="background-color:#212529;" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a style="color:gray;" class="dropdown-item" href="{{route('frontend.user')}}">Thông tin tài khoản</a>
                                    <a  style="color:gray;" class="dropdown-item" href="{{route('admin.logout')}}">Đăng xuất</a>
                                </div>
                                @endif
                            </div>
                            
                        </li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{route ('admin.login')}}">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route ('getRegister')}}">Đăng ký</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#modelSearch" ><i class="fas fa-search"></i></a></li>
                        <li class="nav-item"><button  data-toggle="modal" data-target="#exampleModal" class="nav-link" style="background-color:#212529; border:none; out-line:none;" >
                            <i class="fas fa-shopping-cart" ></i></button>
                        </li>
                        @if(Cart::count() == 0)
                        <li><span class="count-holder">
                                <span>(0)</span>
                            </span>
                        </li>
                        @else
                        <li><span class="count-holder">
                                <span>({{Cart::count()}})</span>
                            </span>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
    </nav>
    <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Our Studio!</div>
              
            </div>
    </header>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @if(Cart::count() == 0)
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hiện tại không có sản phẩm trong giỏ hàng</h5>
                    <button type="button" style="border:none;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @else
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Có {{Cart::count()}} sản phẩm trong giỏ hàng</h5>
                    <button type="button" style="border:none;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($cart as $item)
                    <div class="row">
                        <div class="col-3">
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
                    <div class="row" style="margin-top:30px;">
                        <div class="col">
                            <a href="{{route('frontend.cart.view')}}" type="button" class="btn btn-outline-secondary">Xem giỏ hàng</a>
                        </div>
                        <div class="col">
                            <a href="{{route('frontend.cart.pay')}}" style="float:right;" type="button" class="btn btn-outline-secondary">Thanh toán</a>
                        </div>
                        
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modelSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('frontend.category.search')}}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="model-header" style="height:50px;">
                    <input class="form" name="searchText" id="textSearch" type="text" placeholder="Search.." style="margin-top:10px;margin-left:10px;border:none; outline: none;width:90%">
                    <button type="submit" style="margin-top:10px;margin-right:10px;float:right;border:none;outline: none;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js')}}"></script>
    <script src="{{ asset('js/cart.js')}}"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
        function showcart() {
            var x = document.getElementById("site-cart");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        function showSearch() {
            var x = document.getElementById("myInput");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

</body>
</html>