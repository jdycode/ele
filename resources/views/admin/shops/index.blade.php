@extends("layouts.admin.default")

@section("title","商家列表")

@section("content")
    <div class="container">
        <a href="{{route('shops.add')}}" class="glyphicon glyphicon-plus "></a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>店铺类型</th>
                <th>商家名称</th>
                <th>店铺图片</th>
                {{--<th>起送金额</th>--}}
                {{--<th>配送费</th>--}}
                <th>店公告</th>
                <th>商家状态</th>
                <th>操作</th>
            </tr>
            @foreach($shops as $shop)
                <tr>
                    <td>{{$shop->shopCate->name}}</td>
                    <td>{{$shop->shop_name}}</td>
                    @if($shop->shop_img)
                        <td><img src="/uploads/{{$shop->shop_img}}" width="50"/></td>
                    @else
                        <td><img src="/uploads/books/1.gif" width="50"/></td>
                    @endif
                    {{--<td>{{$shop->brand==1?'是':'否'}}</td>--}}
                    {{--<td>{{$shop->start_send}}</td>--}}
                    {{--<td>{{$shop->send_cost}}</td>--}}
                    <td>{{$shop->notice}}</td>
                    @if($shop->status==1)
                        <td> <button class="btn-xs btn-success">正常</button> </td>

                    @elseif($shop->status==0)
                        <td> <button class="btn-xs btn-info">待审</button> </td>
                    @elseif($shop->status==-1)
                        <td> <button class="btn-xs btn-danger">禁用</button> </td>
                    @endif

                    <td>
                        {{--@if($shop->status===0)--}}
                        {{--<a href="{{route('shops.on',$shop->id)}}">审核</a>--}}
                        {{--@endif--}}
                        <a href="{{route('shops.on',$shop)}}" class="glyphicon glyphicon-ok"></a>
                        <a href="{{route('shops.off',$shop)}}" class="glyphicon glyphicon-remove"></a>
                        <a href="{{route('shops.edit',$shop)}}" class="glyphicon glyphicon-edit"></a>
                        <a href="{{route('shops.del',$shop)}}" class="glyphicon glyphicon-trash"onclick="return confirm('确定要删除这条数据吗？')"></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{$shops->links()}}
@endsection