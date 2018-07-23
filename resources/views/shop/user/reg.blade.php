@extends("layouts.shop.default")
@section('content')
    <h1 class="text-center">商家注册</h1>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: min-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="" >店铺名称</label>
            <input type="text"  name="shop_name"class="form-control" id="" placeholder="店铺名称" value="{{old('shop_name')}}">
        </div>
        <label for="" >店铺分类</label>
        <select name="shop_category_id">
            @foreach($cates as $cate)
                <option  value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="" >评分</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="shop_rating" placeholder="" value="{{old('shop_rating')}}">
        </div>
        <div class="form-group" >
            <label for="">起送金额</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="start_send" placeholder="" value="{{old('start_send')}}">
        </div>
        <div class="form-group" >
            <label for="" >配送费</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="send_cost" placeholder="" value="{{old('send_cost')}}">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">店公告</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="notice" placeholder="" value="{{old('notice')}}">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">优惠信息</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="discount" placeholder="" value="{{old('discount')}}">
        </div>

        是否品牌：<div class="radio">
            <label>
                <input type="radio" name="brand" value="1" @if(old('brand')==1) checked @endif /> 是
            </label>
            <label>
                <input type="radio" name="brand" value="0" @if(old('brand')==0) checked @endif> 否
            </label>
        </div>
        是否准时送达：<div class="radio">
            <label>
                <input type="radio" name="on_time" value="1" @if(old('on_time')==1) checked @endif> 是
            </label>
            <label>
                <input type="radio" name="on_time" value="0" @if(old('on_time')==0) checked @endif> 否
            </label>
        </div>
        是否蜂鸟配送：<div class="radio" >
            <label>
                <input type="radio" name="fengniao" value="1" @if(old('fengniao')==1) checked @endif> 是
            </label>
            <label>
                <input type="radio" name="fengniao" value="0" @if(old('fengniao')==0) checked @endif> 否
            </label>
        </div>
        是否保标记：<div class="radio" >
            <label>
                <input type="radio"name="bao" value="1" @if(old('bao')==1) checked @endif> 是
            </label>
            <label>
                <input type="radio" name="bao" value="0" @if(old('bao')==0) checked @endif> 否
            </label>
        </div>
        是否票标记：<div class="radio" >
            <label>
                <input type="radio" name="piao" value="1" @if(old('piao')==1) checked @endif> 是
            </label>
            <label>
                <input type="radio" name="piao" value="0" @if(old('piao')==0) checked @endif> 否
            </label>
        </div>
        是否准标记：<div class="radio" >
            <label>
                <input type="radio" name="zhun" value="1" @if(old('zhun')==1) checked @endif> 是
            </label>
            <label>
                <input type="radio" name="zhun" value="0" @if(old('zhun')==0) checked @endif> 否
            </label>
        </div>


        <div class="form-group" >
            <label for="exampleInputPassword1">帐号</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="帐号" name="name">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">邮箱</label>
            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="邮箱" name="email">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password">
        </div>
        <div class="form-group" >
            <label>头像</label>
            <input type="file" name="shop_img">
        </div>
        <button type="submit" class="btn btn-default">注册</button>
    </form>
@endsection