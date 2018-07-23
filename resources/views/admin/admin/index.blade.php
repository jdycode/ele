@extends("layouts.admin.default")

@section("title","管理员帐号列表")

@section("content")

  {{--<a href="{{route('user.add')}}" class="glyphicon glyphicon-plus">添加信息</a>--}}

<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>Email</th>
        <th>密码</th>

    </tr>
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->password}}</td>
        </tr>
    @endforeach
</table>
@endsection