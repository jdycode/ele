@extends("layouts.shop.default")
@section("title",'修改菜品')
@section("content")
    <form action="" method="post" class="form-inline" enctype="multipart/form-data">
        {{ csrf_field() }}
        名称：<input type="text" name="name" placeholder="" class="form-control" value="{{old('name')}}"><br>
        编号：<input type="text" name="type_accumulation" placeholder="" class="form-control" value="{{old('name')}}"><br>
        商家：<select class="form-control" name="shop_id">
            <option value="1">1</option>
        </select><br>
        简介：<input type="text" name="description" placeholder="" class="form-control" value="{{old('description')}}"><br>
        是否默认：<div class="radio" >
            <label>
                <input type="radio" name="is_selected" value="1"> 是
            </label>
            <label>
                <input type="radio" name="is_selected" value="0"> 否
            </label>
        </div><br>
        <input type="submit" value="提交" class="btn btn-success">
    </form>
@endsection