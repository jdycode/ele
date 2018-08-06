@extends("layouts.admin.default")

@section("title","活动列表")

@section("content")
    <div class="container">
        <a href="{{route('activity.add')}}" class="glyphicon glyphicon-plus "></a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>id</th>
                <th>活动标题</th>
                <th>活动内容</th>
                <th>活动开始时间</th>
                <th>活动结束时间</th>
                <th>操作</th>
            </tr>
            @foreach($acts as $act)
                <tr>
                    <td>{{$act->id}}</td>
                    <td>{{$act->title}}</td>
                    <td>{!!$act->content!!}</td>
                    <td>{{$act->start_time}}</td>
                    <td>{{$act->end_time}}</td>
                    <td>
                        <a href="{{route('activity.edit',$act)}}" class="glyphicon glyphicon-edit"></a>
                        <a href="{{route('activity.del',$act)}}" class="glyphicon glyphicon-trash"onclick="return confirm('确定要删除这条数据吗？')"></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{$acts->links()}}
@endsection