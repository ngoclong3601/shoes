@extends('admin')
@section('content')
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Tên sản phẩm 

      </th>
      <th class="th-sm">Kích cỡ    

      </th>
      <th class="th-sm">Giá sản phẩm

      </th>
      <th class="th-sm">Số lượng trong kho

      </th>
      <th class="th-sm">Action
           
      </th>
      
    </tr>
  </thead>
  <tbody>
    @foreach($list_product as $list)
    <tr>
      <td>{{$list->product_name}}</td>
      <td>{{$list->name_size}}</td>
      <td>{{ number_format($list->price) }} VND</td>
      <td>{{$list->quantity}}</td>
      <td>
            <a href="#">Chỉnh sửa</a>
            <a style="float:right;" href="#">Xóa</a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>Tên sản phẩm
      </th>
      <th>Kích cỡ
      </th>
      <th>Giá sản phẩm 
      </th>
      <th>Số lượng trong kho
      </th>
      <th>Action
      </th>
      
    </tr>
  </tfoot>
</table>

@endsection
