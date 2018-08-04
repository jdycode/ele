@extends("layouts.admin.default")

@section("title","权限管理")

@section("content")
    <h2 class="text-center">角色权限管理</h2>
    <a href="{{route('role.add')}}" class="glyphicon glyphicon-plus"></a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>权限组</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->guard_name}}</td>
                <td>{{ str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}</td>
                <td>
                    <a href="{{route('role.edit',$role)}}" class="glyphicon glyphicon-edit"></a>
                    {{--@if($role->id!==1)--}}
                    <a href="{{route('role.del',$role)}}" class="glyphicon glyphicon-trash"></a>
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
    </table>
@endsection