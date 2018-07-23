@extends("layouts.shop.default")
@section('content')
    <h1 class="text-center">商家登录</h1>
<form class="container" action="" method="post">
    {{csrf_field()}}
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
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> 记住我
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">登录</button>
        </div>
    </div>
</form>
    @endsection