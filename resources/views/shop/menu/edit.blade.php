@extends("layouts.shop.default")

@section("title","修改菜品")

@section("content")
    <div class="box box-primary">
        <!-- form start -->
        <form role="form" method="post" action="" class="col-lg-2" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box-body">
                添加分类:
                <div class="form-group">
                    <select name="category_id" class="form-control">
                        @foreach($cates as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">名称</label>
                    <input type="text" class="form-control" id="name" placeholder="分类名称" name="goods_name"
                           value="{{old('goods_name',$menu->goods_name)}}">
                </div>
                <div class="form-group">
                    <label for="goods_price">价格</label>
                    <input type="text" class="form-control" id="goods_price" placeholder="价格"
                           name="goods_price" value="{{old('goods_price',$menu->goods_price)}}">
                </div>
                <div class="form-group">
                    <label for="description">描述</label>
                    <textarea class="form-control" name="description">
{{old('description')}}
                    </textarea>
                </div>
                <input type="file" name="goods_img" id="goods_img">
                <div id="uploader-demo" class="wu-example">
                    <div id="fileList" class="uploader-list">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>
@endsection