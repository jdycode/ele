@extends("layouts.admin.default")

@section("title","抽奖活动列表")

@section("content")
    <div class="container">
        <a href="{{route('event.add')}}" class="glyphicon glyphicon-plus "></a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>id</th>
                <th>活动标题</th>
                <th>活动内容</th>
                <th>活动报名时间</th>
                <th>活动报名结束时间</th>
                <th>开奖日期</th>
                <th>报名人数</th>
                <th>是否开奖</th>
                <th>操作</th>
            </tr>
            @foreach($eves as $eve)
                <tr>
                    <td>{{$eve->id}}</td>
                    <td>{{$eve->title}}</td>
                    <td>{{$eve->content}}</td>
                    <td>{{$eve->signup_start}}</td>
                    <td>{{$eve->signup_end}}</td>
                    <td>{{$eve->prize_date}}</td>
                    <td>{{$eve->signup_num}}</td>
                    <td>{{$eve->is_prize===1?'已开奖':'未开奖'}}</td>
                    <td>
                        @if($eve->is_prize===0)
                        <a href="{{route('event.open',$eve)}}" class="btn btn-info">开奖</a>
                        @endif
                        <a href="{{route('event.edit',$eve)}}" class="glyphicon glyphicon-edit"></a>
                        <a href="{{route('event.del',$eve)}}" class="glyphicon glyphicon-trash"onclick="return confirm('确定要删除这条数据吗？')"></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{--{{$eves->links()}}--}}
@endsection