@extends("layouts.shop.default")

@section("title","活动报名")

@section("content")
    <h2 class="text-center">活动报名</h2>
    <table class="table table-bordered table-hover">
        <tr>
            <th>活动标题</th>
            <td>{{$eve->title}}</td>
        </tr>
        <tr>
            <th>活动内容</th>
            <td>{{$eve->content}}</td>
        </tr>
        <tr>
            <th>活动报名时间</th>
            <td>{{$eve->signup_start}}</td>
        </tr>
        <tr>
            <th>活动报名结束时间</th>
            <td>{{$eve->signup_end}}</td>
        </tr>
        <tr>
            <th>开奖日期</th>
            <td>{{$eve->prize_date}}</td>
        </tr>
        <tr>
            <th>报名人数</th>
            <td>{{$eve->signup_num}}人</td>
        </tr>
        <tr>
            <th>已报名人数</th>
            <td>{{$eve->num}}人</td>
        </tr>
        <tr>
            <th>操作</th>
            <td>
          
                @if($eve->num < $eve->signup_num)
                    <a href="{{route('event.check',$eve)}}" class="btn btn-info">报名</a>
                @else
                    <a href="" class="btn btn-info">报名人数已满</a>
                @endif
            </td>
        </tr>

    </table>
    {{--{{$eves->links()}}--}}
@endsection