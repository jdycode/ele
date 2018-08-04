@extends("layouts.admin.default")

@section("title","导航管理")

@section("content")
  <h2 class="text-center">导航管理</h2>
  <a href="{{route('nav.add')}}" class="glyphicon glyphicon-plus"></a>
<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>路由</th>
        <th>上级目录</th>
        <th>操作</th>
    </tr>
    @foreach($data as $val)
        <tr>
            <td>{{$val->id}}</td>
            <td>{{$val->name}}</td>
            <td>{{$val->url}}</td>
            <td>{{$val->pid}}</td>
            <td>
                <a href="{{route('nav.del',$val)}}" class="glyphicon glyphicon-trash"></a>
            </td>
        </tr>
    @endforeach
</table>
    {{$data->links()}}
@endsection