@extends("layouts.admin.default")
@section("title",'添加商家')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: min-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="" >名称</label>
            <input type="text"  name="shop_name"class="form-control" id="" placeholder="">
        </div>
        <select name="shop_category_id">
            @foreach($cates as $cate)
            <option  value="{{$cate->id}}">{{$cate->name}}</option>
                @endforeach
        </select>
        <div class="form-group">
            <label for="" >评分</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="shop_rating" placeholder="">
        </div>

        是否品牌：<div class="checkbox">
            <label>
                <input type="checkbox" name="brand" value="1"> 是
            </label>
            <label>
                <input type="checkbox" name="brand" value="0"> 否
            </label>
        </div>
        是否准时送达：<div class="checkbox">
            <label>
                <input type="checkbox" name="on_time" value="1"> 是
            </label>
            <label>
                <input type="checkbox" name="on_time" value="0"> 否
            </label>
        </div>
        是否蜂鸟配送：<div class="checkbox" >
            <label>
                <input type="checkbox" name="fengniao" value="1"> 是
            </label>
            <label>
                <input type="checkbox" name="fengniao" value="0"> 否
            </label>
        </div>
        是否保标记：<div class="checkbox" >
            <label>
                <input type="checkbox"name="bao" value="1"> 是
            </label>
            <label>
                <input type="checkbox" name="bao" value="0"> 否
            </label>
        </div>
        是否票标记：<div class="checkbox" >
           <label>
                <input type="checkbox" name="piao" value="1"> 是
            </label>
            <label>
                <input type="checkbox" name="piao" value="0"> 否
            </label>
        </div>
        是否准标记：<div class="checkbox" >
            <label>
                <input type="checkbox" name="zhun" value="1"> 是
            </label>
            <label>
                <input type="checkbox" name="zhun" value="0"> 否
            </label>
        </div>
        状态： <div class="checkbox" >
            <label>
                <input type="checkbox" name="status" value="1"> 正常
            </label>
            <label>
                <input type="checkbox" name="status" value="0"> 待审核
            </label>
            <label>
                <input type="checkbox" name="status" value="-1">禁用
            </label>
        </div>

        <div class="form-group" >
            <label for="">起送金额</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="start_send" placeholder="">
        </div>
        <div class="form-group" >
            <label for="" >配送费</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="send_cost" placeholder="">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">店公告</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="notice" placeholder="">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">优惠信息</label>
            <input type="text" class="form-control" id="exampleInputPassword1"name="discount" placeholder="">
        </div>
        <div class="form-group" >
            <label>头像</label>
            <input type="file" name="img">
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection