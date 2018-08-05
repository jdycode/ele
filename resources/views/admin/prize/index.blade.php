@extends("layouts.admin.default")

@section("title","奖品列表")

@section("content")

  <a href="{{route('prize.add')}}" class="glyphicon glyphicon-plus "></a>

<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>活动</th>
        <th>奖品名称</th>
        <th>奖品详情</th>
        <th>中奖商家账号</th>
        <th>操作</th>
    </tr>
    @foreach($prs as $pr)
        <tr>
            <td>{{$pr->id}}</td>
            <td>{{$pr->events_id}}</td>
            <td>{{$pr->name}}</td>
            <td>{{$pr->description}}</td>
            <td></td>
            <td>
                <a href="{{route('prize.edit',$pr)}}" class="glyphicon glyphicon-edit"></a>
                <a href="{{route('prize.del',$pr)}}" class="glyphicon glyphicon-trash"onclick="return confirm('确定要删除这条数据吗？')"></a>
            </td>
        </tr>
    @endforeach
</table>
    {{--{{$eves->links()}}--}}
@endsection