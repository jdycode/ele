@extends("layouts.admin.default")
@section('content')
    <h2 class="text-center">编辑权限</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputPassword1">角色</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="name"  value="{{old('name',$roles->name)}}">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">组名</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="guard_name"  value="{{old('guard_name',$roles->guard_name)}}">
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">权限</label>
            @foreach($pers as $per)
            <input type="checkbox" id="exampleInputPassword1" placeholder="权限" name="role[]" @if($roles->hasPermissionTo($per->name)) checked @endif
            value="{{old('name',$per->name)}}">{{$per->name}}
                @endforeach
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection