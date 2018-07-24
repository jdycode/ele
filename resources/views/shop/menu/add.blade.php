@extends("layouts.shop.default")

@section("title","菜品分类列表")

@section("content")
    <form action="" method="post" class="form-inline" enctype="multipart/form-data">
        {{ csrf_field() }}
        商品名称：<input type="text" name="goods_name" placeholder="" class="form-control" value="{{old('goods_name')}}"><br><hr>
        评分：<input type="text" name="rating" placeholder="" class="form-control" value="{{old('rating')}}"><br><hr>
        所属商家：<select class="form-control" name="shop_id">
            @foreach($cates as $cate)
                <option value="{{$cate->shop_name}}">{{$cate->shop_name}}</option>
            @endforeach
        </select><br><hr>
        所属分类：<select class="form-control" name="category_id">
            @foreach($menus as $menu)
                <option value="{{$menu->name}}">{{$menu->name}}</option>
            @endforeach
        </select><br><hr>
        价格：<input type="text" name="goods_price" placeholder="" class="form-control" value="{{old('goods_price')}}"><br><hr>
        描述：<input type="text" name="description" placeholder="" class="form-control" value="{{old('description')}}"><br><hr>
        月销量：<input type="text" name="month_sales" placeholder="" class="form-control" value="{{old('month_sales')}}"><br><hr>
        评分数量：<input type="text" name="rating_count" placeholder="" class="form-control" value="{{old('rating_count')}}"><br><hr>
        提示信息：<input type="text" name="tips" placeholder="" class="form-control" value="{{old('tips')}}"><br><hr>
        满意度数量：<input type="text" name="satisfy_count" placeholder="" class="form-control" value="{{old('satisfy_count')}}"><br><hr>
        满意度评分：<input type="text" name="satisfy_rate" placeholder="" class="form-control" value="{{old('satisfy_rate')}}"><br><hr>
        商品图片：<input type="file" name="goods_img" placeholder="" style="width: 15%" class="form-control" value=""><br><hr>
        是否上架：<select class="form-control" name="status">
            <option value="1">是</option>
            <option value="0">否</option>
        </select><br><hr>
        <input type="submit" value="提交" class="btn btn-success">
    </form>
@endsection