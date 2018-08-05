@extends("layouts.admin.default")
@section("title",'充值')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">会员名</label>
            <input type="text" class="form-control" id="" placeholder="" name="username" value="{{old('username')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">电话号码</label>
            <input type="text" class="form-control" id="" placeholder="" name="tel">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="" placeholder="" name="password">
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection