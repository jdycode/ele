@extends("layouts.admin.default")

@section("title","权限管理")

@section("content")
  <h2 class="text-center">权限管理</h2>
  <a href="{{route('per.add')}}" class="glyphicon glyphicon-plus"></a>
<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>权限</th>
        <th>权限组</th>
        <th>操作</th>

    </tr>
    @foreach($pers as $per)
        <tr>
            <td>{{$per->id}}</td>
            <td>{{$per->name}}</td>
            <td>{{$per->guard_name}}</td>
            {{--<td>{{$per->password}}</td>--}}
            <td>
                <a href="{{route('per.edit',$per)}}" class="glyphicon glyphicon-edit"></a>
                {{--@if($per->id!==1)--}}
                <a href="" class="glyphicon glyphicon-trash"></a>
                    {{--@endif--}}
            </td>
        </tr>
    @endforeach
</table>
@endsection