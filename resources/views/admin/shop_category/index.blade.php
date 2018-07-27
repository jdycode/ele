@extends("layouts.admin.default")

@section("title","商家列表")

@section("content")
    <a href="{{route('shop_category.add')}}"><i class=" glyphicon glyphicon-plus"></i></a>
    <form class="form-inline" action="" method="get">
        {{--<div class="form-group">--}}
        {{--<a href="{{route('shop_category.add')}}" class="btn btn-success ">添加商家</a>--}}
        {{--</div>--}}
    </form>

    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>商家名称</th>
            <th>商家简介</th>
            <th>商家图片</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>{{$cate->intro}}</td>
                @if($cate->logo)
                    <td><img src="/uploads/{{$cate->logo}}" width="50"/></td>
                @else
                    <td></td>
                @endif
                <td>
                    <a href="{{route('shop_category.edit',$cate)}}" class="glyphicon glyphicon-check"></a>
                    <a href="{{route('shop_category.del',$cate)}}" class="glyphicon glyphicon-trash" onclick="return confirm('确定要删除这条数据吗？')"></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$cates->links()}}
@endsection