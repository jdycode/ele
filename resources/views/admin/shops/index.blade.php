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
        {{--<th>是否准时送达</th>--}}
        {{--<th>是否蜂鸟配送</th>--}}
        {{--<th>是否保标记</th>--}}
        {{--<th>是否票标记</th>--}}
        {{--<th>是否准标记</th>--}}
        <th>起送金额</th>
        <th>配送费</th>
        <th>店公告</th>
        {{--<th>优惠信息</th>--}}
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
            {{--<td>{{$shop->on_time==1?'是':'否'}}</td>--}}
            {{--<td>{{$shop->fengniao==1?'是':'否'}}</td>--}}
            {{--<td>{{$shop->bao==1?'是':'否'}}</td>--}}
            {{--<td>{{$shop->piao==1?'是':'否'}}</td>--}}
            {{--<td>{{$shop->zhun==1?'是':'否'}}</td>--}}
            <td>{{$shop->start_send}}</td>
            <td>{{$shop->send_cost}}</td>
            <td>{{$shop->notice}}</td>
            {{--<td>{{$shop->discount}}</td>--}}
            {{--<td>{{\App\Models\Shop::$statusArray[$shop->status]}}</td>--}}
            @if($shop->status==1)
                <td> <button class="btn btn-success">正常</button> </td>

            @elseif($shop->status==0)
              <td> <button class="btn btn-info">待审</button> </td>
            @elseif($shop->status==-1)
              <td> <button class="btn btn-danger">禁用</button> </td>
           @endif

            <td>
                {{--@if($shop->status===0)--}}
                    {{--<a href="{{route('shops.on',$shop->id)}}">审核</a>--}}
                {{--@endif--}}
                <a href="{{route('shops.on',$shop)}}">审核</a>
                <a href="{{route('shops.off',$shop)}}">禁用</a>
                <a href="{{route('shops.edit',$shop)}}" class="glyphicon glyphicon-edit">编辑</a>
                <a href="{{route('shops.del',$shop)}}" class="glyphicon glyphicon-trash"onclick="return confirm('确定要删除这条数据吗？')"></a>
            </td>
        </tr>
    @endforeach
</table>
@endsection