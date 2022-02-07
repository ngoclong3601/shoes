<h1>Dưới đây là các mặt hàng của bạn:</h1>
<ul>
@foreach ($cart as $key => $value['items'])
    @foreach($value['items'] as $key=>$v)
        <li>
            <div>
                Tên hàng: {{$v->name}} <br>
                Số lượng: {{$v->qty}} <br>
                Giá: {{number_format($v->price)}} VNĐ  <br>
                Size: {{$v->options->size}} <br>
            </div>
        </li>
    @endforeach
    Tổng tiền: {{Cart::subtotal()}} VNĐ
@endforeach

</ul>