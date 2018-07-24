@extends("layouts.admin.default")
@section('content')
    <h2 class="text-center">修改密码</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputPassword1">旧密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="" name="oldpassword" value="">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="" name="newpassword">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">确认新密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="newpassword">
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection