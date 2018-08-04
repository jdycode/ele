@extends("layouts.admin.default")
@section('content')
    <h2 class="text-center">添加导航</h2>
    <hr>
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputPassword1">导航栏名称</label>
            <input type="text" id="exampleInputPassword1" placeholder="" name="name" value=""/>
        </div>
        <div class="form-group" >
            <label for="exampleInputPassword1">上一级目录</label>
            <select name="pid">
                <option value="0">一级目录</option>
                @foreach($navs as $nav)
                    <option value="{{$nav->id}}">{{$nav->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" >
            <label for="exampleInputPassword1">路由</label>
            <select name="url">
                @foreach($urls as $url)
                <option value="{{$url}}">{{$url}}</option>
                    @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection