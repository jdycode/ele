@extends("layouts.shop.default")

@section("title","每日统计")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-tools">
                            <form action="" class="form-inline">
                                <select name="status" class="form-control">
                                    <option value="0">待支付</option>
                                    <option value="1">待发货</option>
                                    <option value="2">待确认</option>
                                    <option value="3">已完成</option>
                                </select>
                                <input type="text" name="keyword" class="form-control" placeholder="订单编号"
                                       value="{{request()->input('keyword')}}">
                                <input type="submit" value="搜索" class="btn btn-success">
                            </form>

                        </div>
                    </div>
                    <br>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>姓名</th>
                                <th>电话</th>
                                {{--<th>地址</th>--}}
                                <th>订单号</th>
                                <th>总价</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->tel}}</td>
                                    {{--<td>{{$order->provence.$order->city.$order->area.$order->detail_address}}</td>--}}
                                    <td>{{$order->sn}}</td>
                                    <td>{{$order->total}}</td>
                                    {{--<td>{{$order->OrderStatus}}</td>--}}
                                    <td>
                                        <a href="{{route('order.select',$order)}}" class="btn btn-info">查看</a>
                                        @if($order->status===0)
                                            <a href="{{route('order.change',[$order->id,1])}}" class="btn btn-default">发货</a>
                                        @endif
                                        @if($order->status===1)
                                            <a href="{{route('order.change',[$order->id,2])}}" class="btn btn-default">确认</a>
                                        @endif
                                        @if($order->status===2)
                                            <a href="{{route('order.change',[$order->id,3])}}" class="btn btn-default">完成</a>
                                        @endif
                                        @if($order->status！==-1 && $order->status!==3)
                                            <a href="{{route('order.change',[$order->id,-1])}}" class="btn btn-default">取消</a>
                                        @endif
                                    </td>
                                    <td>

                                        <a href="" class="glyphicon glyphicon-trash"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{$orders ->links()}}
@endsection