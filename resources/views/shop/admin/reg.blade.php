@extends("layouts.shop.default")
@section('content')
<form class="form-horizontal" action="" method="post">
    {{csrf_field()}}
    <h4 style="">用户注册</h4>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
            <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="">
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
            <button type="submit" class="btn btn-default">注册</button>
        </div>
    </div>
</form>
    @endsection