@extends('layout.app')

@section('contents')
    <h1>抽奖添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('events.store')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">活动名</label>
            <input type="text" class="form-control" name="title" placeholder="请输入活动">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">详情</label>
            <input type="text" class="form-control" name="content" placeholder="请输入活动详情">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">开始时间</label>
            <input type="date" class="form-control" name="signup_start" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">结束详情</label>
            <input type="date" class="form-control" name="signup_end" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">开奖时间</label>
            <input type="date" class="form-control" name="prize_date">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">人数限制</label>
            <input type="number" class="form-control" name="signup_num" placeholder="请输入人数">
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



