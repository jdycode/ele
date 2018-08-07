@extends("layouts.shop.default")
@section("title",'添加抽奖活动')
@section("content")
    <form class="container" action="" method="post" enctype="multipart/form-data" style="width: fit-content">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">标题</label>
            <input type="text" class="form-control" id="" placeholder="标题" name="title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">报名开始时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="报名开始时间" name="signup_start">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">报名结束时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="活动结束时间" name="signup_end">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">开奖日期</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="开奖日期" name="prize_date">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">报名人数</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="报名人数" name="signup_num">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">活动详情</label><br>
            <textarea name="content" class="form-control" ></textarea>
        </div>

        <button type="submit" class="btn btn-default">提交</button>
    </form>
@endsection