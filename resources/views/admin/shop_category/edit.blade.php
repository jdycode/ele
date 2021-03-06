@extends("layouts.admin.default")
@section("title",'修改商家')
@section("content")
    <form action="" method="post" class="container" style="width: min-content"enctype="multipart/form-data">
        {{ csrf_field() }}
        名称：<input type="text" name="name" placeholder="" class="form-control" value="{{old('name',$cates->name)}}"><br>
        简介：<input type="text" name="intro" placeholder="" class="form-control" value="{{old('intro',$cates->intro)}}"><br>
        是否显示：<select class="form-control" name="status">
            <option value="1">是</option>
            <option value="0">否</option>
        </select><br>
        商品图片：<input type="file" name="img" placeholder="" style="width: 200%" class="form-control" value=""><br>
        <img src="/uploads/{{$cates->logo}}" width="100"/>
        <input type="submit" value="提交" class="btn btn-success"/>
    </form>
@endsection