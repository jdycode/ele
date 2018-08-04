@extends("layouts.admin.default")
@section('content')
    <h2 class="text-center">权限添加</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputPassword1">权限</label>
            <select name="name">
                @foreach($urls as $url)
                <option value="{{$url}}">{{$url}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">权限组</label>
            <input type="text" id="exampleInputPassword1" placeholder="" name="guard_name" value=""/>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection