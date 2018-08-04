@extends("layouts.admin.default")
@section('content')
    <h2 class="text-center">权限修改</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputPassword1">权限</label>
            <input type="checkbox"  id="exampleInputPassword1" placeholder="" name="name" value="{{old('name',$pers->name)}}">{{$pers->name}}
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">权限组</label>
            <input type="text" id="exampleInputPassword1" placeholder="guard_name" name="guard_name" value="{{old('name',$pers->guard_name)}}"/>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection