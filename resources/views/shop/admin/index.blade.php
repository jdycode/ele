@extends("layouts.shop.default")

@section("title","商家列表")

@section("content")

  {{--<a href="{{route('admin.add')}}" class="glyphicon glyphicon-plus">添加信息</a>--}}

<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>Email</th>
        <th>用户状态</th>
        <th>所属商家</th>
        <th>操作</th>
    </tr>
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->status}}</td>
            <td>{{$admin->shop_id}}</td>
            <td>
                <a href="{{route('admin.edit',$admin)}}" class="glyphicon glyphicon-edit">编辑</a>
                <a href="{{route('admin.del',$admin)}}" class="glyphicon glyphicon-trash">删除</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection