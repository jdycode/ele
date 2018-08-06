@extends("layouts.shop.default")

@section("title","菜品分类列表")

@section("content")
    <div class="container">
        <a href="{{route('menu_cate.add')}}"><i class="glyphicon glyphicon-plus "></i></a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>id</th>
                <th>名称</th>
                <th>描述</th>
                <th>默认</th>
                <th>操作</th>
            </tr>
            @foreach($cates as $cate)
                <tr>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td>{{$cate->description}}</td>
                    <td>{{$cate->is_selected==1?'是':'否'}}</td>
                    <td>
                        <a href="{{route('menu_cate.edit',$cate)}}" class="glyphicon glyphicon-edit"></a>
                        <a href="{{route('menu_cate.del',$cate)}}" class="glyphicon glyphicon-trash" onclick="return confirm('确定要删除这条数据吗？')"></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{$cates->links()}}
@endsection