@extends("layouts.admin.default")

@section("title","会员列表")

@section("content")

    <div class="container">
        <a href="{{route('member.add')}}" class="glyphicon glyphicon-plus "></a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>id</th>
                <th>会员名</th>
                <th>电话号码</th>
                <th>账户余额</th>
                <th>积分</th>
                <th>操作</th>
            </tr>
            @foreach($mem as $val)
                <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->username}}</td>
                    <td>{{$val->tel}}</td>
                    <td>{{$val->money}}</td>
                    <td>{{$val->jifen}}</td>
                    <td>
                        <a href="{{route('member.edit',$val)}}" class="btn btn-info">充值</a>
                        <a href="{{route('member.del',$val)}}" class="btn btn-danger"onclick="return confirm('确定要删除这条数据吗？')">删除</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{$mem->links()}}
@endsection