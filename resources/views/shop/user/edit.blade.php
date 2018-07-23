@extends("layouts.shop.default")
@section('content')
    <h4 >修改用户</h4>
<form class="form-horizontal" action="" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="inputEmail3" placeholder="" name="name" value="{{old('name',$users->name)}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
            <input type="email" class="form-control" id="inputEmail3" placeholder="" name="email" value="{{old('email',$users->email)}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">用户密码</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="inputPassword3" placeholder="" name="password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>
    @endsection