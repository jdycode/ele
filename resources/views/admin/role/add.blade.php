@extends("layouts.admin.default")
@section('content')
    <h2 class="text-center">添加权限</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputPassword1">角色</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="name">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">权限</label>
            @foreach($pers as $per)
            <input type="checkbox" id="exampleInputPassword1" placeholder="权限" name="role[]" value="{{$per->name}}">{{$per->name}}
                @endforeach
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection