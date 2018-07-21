@extends("layouts.admin.default")
@section("title",'修改商家')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: min-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="" >名称</label>
            <input type="text"  name="shop_name"class="form-control" id="" placeholder="" value="{{old('shop_name',$shops->shop_name)}}">
        </div>
        <select name="shop_category_id">
            @foreach($cates as $cate)
                <option  value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="" >评分</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="shop_rating" placeholder="" value="{{old('shop_rating',$shops->shop_rating)}}">
        </div>

        是否品牌：<div class="checkbox">
            <label>
                <input type="checkbox" @if($shops->brand===1) checked @endif name="brand" value="1"> 是
            </label>
            <label>
                <input type="checkbox" @if($shops->brand===0) checked @endif name="brand" value="0"> 否
            </label>
        </div>
        是否准时送达：<div class="checkbox">
            <label>
                <input type="checkbox"  @if($shops->on_time===1) checked @endif   name="on_time" value="1"> 是
            </label>
            <label>
                <input type="checkbox" @if($shops->on_time===0) checked @endif name="on_time" value="0"> 否
            </label>
        </div>
        是否蜂鸟配送：<div class="checkbox" >
            <label>
                <input type="checkbox"  @if($shops->fengniao===1) checked @endif   name="fengniao" value="1"> 是
            </label>
            <label>
                <input type="checkbox"  @if($shops->fengniao===0) checked @endif   name="fengniao" value="0"> 否
            </label>
        </div>
        是否保标记：<div class="checkbox" >
            <label>
                <input type="checkbox"  @if($shops->bao===1) checked @endif   name="bao" value="1"> 是
            </label>
            <label>
                <input type="checkbox" @if($shops->bao===0) checked @endif  name="bao" value="0"> 否
            </label>
        </div>
        是否票标记：<div class="checkbox" >
            <label>
                <input type="checkbox" @if($shops->piao===1) checked @endif  name="piao" value="1"> 是
            </label>
            <label>
                <input type="checkbox" @if($shops->piao===0) checked @endif  name="piao" value="0"> 否
            </label>
        </div>
        是否准标记：<div class="checkbox" >
            <label>
                <input type="checkbox" @if($shops->zhun===1) checked @endif  name="zhun" value="1"> 是
            </label>
            <label>
                <input type="checkbox" @if($shops->zhun===0) checked @endif  name="zhun" value="0"> 否
            </label>
        </div>
        状态： <div class="checkbox" >
            <label>
                <input type="radio" @if($shops->status===1) checked @endif name="status" value="1"> 正常
            </label>
            <label>
                <input type="radio" @if($shops->status===0) checked @endif name="status" value="0"> 待审核
            </label>
            <label>
                <input type="radio" @if($shops->status===-1) checked @endif name="status" value="-1">禁用
            </label>
        </div>

        <div class="form-group" >
            <label for="">起送金额</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="start_send" placeholder="" value="{{old('start_send',$shops->start_send)}}">
        </div>
        <div class="form-group" >
            <label for="" >配送费</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="send_cost" placeholder="" value="{{old('send_cost',$shops->send_cost)}}">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">店公告</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="notice" placeholder="" value="{{old('notice',$shops->notice)}}">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">优惠信息</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="discount" placeholder="" value="{{old('discount',$shops->discount)}}">
        </div>
        <div class="form-group" >
            <label>头像</label>
            <input type="file" name="img">
            <img src="/uploads/{{$shops->shop_img}}" width="50"/>
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection