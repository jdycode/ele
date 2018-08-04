@extends("layouts.shop.default")

@section("title","查看订单")

@section("content")
    <h2 class="text-center">订单详情</h2>
    <table  border="1" class="table table-hover">
        <tr>
            <th>姓名</th>
            <td>{{$rsts->name}}</td>
        </tr>
        <tr>
            <th>电话</th>
            <td>{{$rsts->tel}}</td>
        </tr>
        <tr>
            <th>地址</th>
            <td>{{$rsts->provence.$rsts->city.$rsts->area.$rsts->detail_address}}</td>
        </tr>
        <tr>
            <th>订单号</th>
            <td>{{$rsts->sn}}</td>
        </tr>
        <tr>
            <th>总价</th>
            <td>{{$rsts->total}}</td>
        </tr>
    </table>
    <table  border="1" class="table table-hover">
        <tr>
            <th>数量</th>
            @foreach($ordergoods as $ordergood)
            <td>{{$ordergood->amount}}份</td>
            @endforeach
        </tr>
        <tr>
            <th>商品</th>
            @foreach($ordergoods as $ordergood)
            <td>{{$ordergood->goods_name}}</td>
                @endforeach
        </tr>
    </table>
@endsection