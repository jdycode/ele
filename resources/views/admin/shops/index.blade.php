@extends("layouts.admin.default")

@section("title","商家列表")

@section("content")

  <a href="{{route('shops.add')}}" class="glyphicon glyphicon-plus ">添加信息</a>

<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>店铺分类id</th>
        <th>商家名称</th>
        <th>店铺图片</th>
        <th>店铺评分</th>
        <th>是否品牌</th>
        <th>是否准时送达</th>
        <th>是否蜂鸟配送</th>
        <th>是否保标记</th>
        <th>是否票标记</th>
        <th>是否准标记</th>
        <th>起送金额</th>
        <th>配送费</th>
        <th>店公告</th>
        <th>优惠信息</th>
        <th>商家状态</th>
        <th>操作</th>
    </tr>
    @foreach($shops as $shop)
        <tr>
            <td>{{$shop->id}}</td>
            <td>{{$shop->shopCate->name}}</td>
            <td>{{$shop->shop_name}}</td>
            @if($shop->shop_img)
                <td><img src="/uploads/{{$shop->shop_img}}" width="50"/></td>
            @else
                <td><img src="/uploads/books/1.gif" width="50"/></td>
            @endif
            <td>{{$shop->shop_rating}}</td>
            <td>{{$shop->brand==1?'是':'否'}}</td>
            <td>{{$shop->on_time==1?'是':'否'}}</td>
            <td>{{$shop->fengniao==1?'是':'否'}}</td>
            <td>{{$shop->bao==1?'是':'否'}}</td>
            <td>{{$shop->piao==1?'是':'否'}}</td>
            <td>{{$shop->zhun==1?'是':'否'}}</td>
            <td>{{$shop->start_send}}</td>
            <td>{{$shop->send_cost}}</td>
            <td>{{$shop->notice}}</td>
            <td>{{$shop->discount}}</td>
            @if($shop->status==1)
                <td>正常</td>
            @elseif($shop->status==0)
                <td>待审核</td>
            @elseif($shop->status==-1)
                <td>禁用</td>
            @endif
            <td>
                <a href="{{route('shops.edit',$shop)}}" class="glyphicon glyphicon-edit">编辑</a>
                <a href="{{route('shops.del',$shop)}}" class="glyphicon glyphicon-trash"></a>
            </td>
        </tr>
    @endforeach
</table>
@endsection