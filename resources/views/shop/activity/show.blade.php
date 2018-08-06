@extends("layouts.shop.default")

@section("title","活动列表")

@section("content")
    <div class="box-header">
            <form action="" method="post" class="form-inline">
                {{csrf_field()}}
                <select name="time" class="form-control">
                    <option  value="">选择</option>
                    <option  value="1">未开始的活动</option>
                    <option  value="0">正在进行的活动</option>
                    <option  value="-1">已结束的活动</option>
                </select>
                <input type="submit" value="搜索" class="btn btn-success">
            </form>
    </div>
<table class="table table-bordered table-hover">
    <tr>
        <th>id</th>
        <th>活动标题</th>
        <th>活动内容</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>
    </tr>
    @foreach($acts as $act)
        <tr>
            <td>{{$act->id}}</td>
            <td>{{$act->title}}</td>
            <td>{!!$act->content!!}</td>
            <td>{{$act->start_time}}</td>
            <td>{{$act->end_time}}</td>
        </tr>
    @endforeach
</table>
    {{--{{$acts->links()}}--}}
@endsection