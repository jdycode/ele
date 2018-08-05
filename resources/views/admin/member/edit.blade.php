@extends("layouts.admin.default")
@section("title",'充值')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">会员名</label>
            <input type="text" class="form-control" id="" placeholder="" name="username" value="{{old('username',$mems->username)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">充值金额</label>
            <input type="text" class="form-control" id="" placeholder="" name="money">
        </div>
        <button type="submit" class="btn btn-default">充值</button>
    </form>
@endsection