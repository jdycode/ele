@extends("layouts.admin.default")

@section("title","管理员帐号列表")

@section("content")

  {{--<a href="{{route('user.add')}}" class="glyphicon glyphicon-plus">添加信息</a>--}}

<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>Email</th>
        <th>权限</th>
        <th>操作</th>

    </tr>
    @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{ str_replace(['[',']','"'],'', $admin->permissions()->pluck('name')) }}</td>
            {{--<td>{{$admin->password}}</td>--}}
            <td>
                <a href="{{route('admin.edit',$admin)}}" class="glyphicon glyphicon-edit"></a>
                @if($admin->id!==1)
                <a href="{{route('admin.del',$admin)}}" class="glyphicon glyphicon-trash"></a>
                    @endif
            </td>
        </tr>
    @endforeach
</table>
@endsection