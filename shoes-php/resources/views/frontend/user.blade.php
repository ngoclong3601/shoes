@extends('layouts.app')
@section('content')
    <section style="background-color:rgb(241, 241, 241);">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="img-user">
                        <img src="https://salt.tikicdn.com/desktop/img/avatar.png" >
                        <div class="info">
                            <strong>{{Auth::user()->name}}</strong>
                        </div>
                    </div>
                    <ul class="ul-user">
                        <li>
                            <a href="{{route('frontend.user')}}" style="text-decoration:none;">Thông tin tài khoản</a>
                        </li>
                        <li>
                            <a href="{{route('changepassword')}}" style="text-decoration:none;">Đổi mật khẩu</a>
                        </li>
                    </ul>
                </div>
                <div class="col-9">
                    <form action="{{route('frontend.user.update')}}" method="post">
                    @csrf
                        <span>Thông tin tài khoản</span>
                        <div class="row" >
                            <div class="col-2">
                                <p style="margin-top:25px;">Họ và tên</p>
                            </div>
                            <div class="col-10">
                                    <div  style="margin-top:20px;">
                                    <input name="name" class="form-control" type="text" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-2">
                                <p style="margin-top:25px;">Địa chỉ</p>
                            </div>
                            <div class="col-10">
                                    <div  style="margin-top:20px;">
                                    <input name="address" class="form-control" type="text" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-2">
                                <p style="margin-top:25px;">Điện thoại</p>
                            </div>
                            <div class="col-10">
                                    <div  style="margin-top:20px;">
                                    <input name="phone" class="form-control" type="text" value="{{Auth::user()->phone}}">
                                </div>
                            </div>
                        </div>
                        <button style="margin-left:45%; margin-top:20px;" class="btn btn-success" type="submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


