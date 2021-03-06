@extends("layouts.shop.default")

@section("title","活动列表")

@section("content")
    <div class="container">
        <table class="table table-bordered table-hover">
            <tr>
                <th>id</th>
                <th>活动标题</th>
                <th>活动内容</th>
                <th>活动报名时间</th>
                <th>活动报名结束时间</th>
                <th>开奖日期</th>
                <th>报名人数</th>
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
                    <td>
                        <a href="{{route('event.show',$eve)}}" class="btn btn-info">查看</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{--{{$eves->links()}}--}}
@endsection