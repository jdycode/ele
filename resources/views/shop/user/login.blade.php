@extends("layouts.shop.default")
@section('content')

    <h2 class="text-center">管理员登录</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">帐号</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="帐号" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">邮箱</label>
            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="邮箱" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password">
        </div>

        <button type="submit" class="btn btn-default">登录</button>
    </form>
@endsection