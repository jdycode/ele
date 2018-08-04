@extends("layouts.shop.default")

@section("title","菜品分类列表")

@section("content")
    <div class="box-header">
        <a href="{{route('menu.add')}}" class="glyphicon glyphicon-plus "></a>

        <div class="box-tools">

            <form action="" class="form-inline">
                <select name="cate_id" class="form-control">
                    <option value="">请选择分类</option>
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}"
                                @if($cate->id==request()->input('cate_id')) selected @endif >{{$cate->name}}</option>
                    @endforeach
                </select>
                <input type="text" name="minPrice" class="form-control" size="2" placeholder="最低价"
                       value="{{request()->input('minPrice')}}"> -
                <input type="text" name="maxPrice" class="form-control" size="2" placeholder="最高价"
                       value="{{request()->input('maxPrice')}}">
                <input type="text" name="keyword" class="form-control" placeholder="菜品名称"
                       value="{{request()->input('keyword')}}">
                <input type="submit" value="搜索" class="btn btn-success">
            </form>


        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>商品名称</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>商品价格</th>
            <th>月销量</th>
            <th>商品图片</th>
            <th>是否上架</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->shop->shop_name}}</td>
                <td>{{$menu->menu->name}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->month_sales}}</td>
                <td><img src="{{$menu->goods_img}}" width="50"></td>
                <td>
                    {{$menu->status==1?'是':'否'}}
                </td>
                <td>
                    <a href="{{route('menu.edit',$menu)}}" class="glyphicon glyphicon-edit"></a>
                    <a href="{{route('menu.del',$menu)}}" class="glyphicon glyphicon-trash"></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menus->links()}}
@endsection