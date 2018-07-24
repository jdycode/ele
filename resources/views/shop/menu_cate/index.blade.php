@extends("layouts.shop.default")

@section("title","菜品分类列表")

@section("content")
    <a href="{{route('menu_cate.add')}}"><i class="fa fa-circle-o"></i>添加菜品</a>
    <form class="form-inline" action="" method="get">
        {{--<div class="form-group">--}}
        {{--<a href="{{route('shop_category.add')}}" class="btn btn-success ">添加商家</a>--}}
        {{--</div>--}}
    </form>

    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>编号</th>
            <th>商家</th>
            <th>描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>{{$cate->type_accumulation}}</td>
                <td>{{$cate->shop->shop_name}}</td>
                <td>{{$cate->description}}</td>
                <td>{{$cate->is_selected==1?'是':'否'}}</td>
                <td>
                    <a href="{{route('menu_cate.edit',$cate)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('menu_cate.del',$cate)}}" class="btn btn-danger" onclick="return confirm('确定要删除这条数据吗？')">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection