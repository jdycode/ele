@extends("layouts.shop.default")

@section("title","菜品分类列表")

@section("content")
    <form class="form-inline" action="" method="get">
        <div class="form-group">
            <select type="text" class="form-control" name="category_id" placeholder="搜索"></select>----
            <select type="text" class="form-control" name="goods_price" placeholder="搜索"></select>----
            <select type="text" class="form-control" name="goods_price" placeholder="搜索"></select>
            <button type="submit" class="btn btn-default">搜索</button>
        </div><br><hr>
        <div class="form-group">
            <a href="{{route('menu.add')}}" class="btn btn-success ">添加商品</a>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>商品名称</th>
            <th>商品评分</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>商品价格</th>
            <th>月销量</th>
            <th>满意度数量</th>
            <th>商品图片</th>
            <th>是否上架</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->shop_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->shop->shop_name}}</td>
                <td>{{$menu->menu->name}}</td>
                <td>{{$menu->price}}</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>
                    <img src="/{{$menu->logo}}" width="50"/>
                </td>
                <td>{{$menu->status==1?'是':'否'}}</td>
                <td>
                    <a href="{{route('menu.edit',$menu)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('menu.del',$menu)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
            @endforeach
    </table>
@endsection