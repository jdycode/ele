@extends("layouts.shop.default")

@section("title","商家列表")

@section("content")

  {{--<a href="{{route('user.add')}}" class="glyphicon glyphicon-plus">添加信息</a>--}}

<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>Email</th>
        <th>用户状态</th>
        <th>所属商家</th>
        <th>操作</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->status==1?'正常':'待审核'}}</td>
            <td>{{$user->shop->shop_name}}</td>
            <td>
                <a href="{{route('user.edit',$user)}}" class="glyphicon glyphicon-edit">编辑</a>
                <a href="{{route('user.del',$user)}}" class="glyphicon glyphicon-trash">删除</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection