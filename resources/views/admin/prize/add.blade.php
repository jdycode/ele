@extends("layouts.admin.default")
@section("title",'添加抽奖活动')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">活动</label>
            <select class="form-control" name="events_id" >
                @foreach($eves as $eve)
                    <option  value="{{$eve->id}}">{{$eve->title}}</option>
            </select>
            @endforeach
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">奖品</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">奖品详情</label><br>
            <textarea name="description" class="form-control" ></textarea>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection