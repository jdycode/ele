@extends("layouts.admin.default")
@section("title",'添加活动')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">标题</label>
            <input type="text" class="form-control" id="" placeholder="标题" name="title" value="{{old('title',$acts->title)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">活动开始时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="活动开始时间" name="start_time" value="{{old('start_time',$acts->start_time)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">活动结束时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="活动结束时间" name="end_time" value="{{old('end_time',$acts->end_time)}}">
        </div>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>
        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection