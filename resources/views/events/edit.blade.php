@extends('layout.app')

@section('contents')
    <h1>抽奖修改</h1>
    @include('layout._errors')
    <form method="post" action="{{route('events.update',[$event])}}">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="form-group">
            <label for="exampleInputEmail1">活动名</label>
            <input type="text" class="form-control" name="title" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">详情</label>
            <input type="text" class="form-control" name="content" value="{{$event->content}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">开始时间</label>
            <input type="date" class="form-control" name="signup_start"  value="{{date('Y-m-d',$event->signup_start)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">结束详情</label>
            <input type="date" class="form-control" name="signup_end"  value="{{date('Y-m-d',$event->signup_end)}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">开奖时间</label>
            <input type="date" class="form-control" name="prize_date" value="{{$event->prize_date}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">人数限制</label>
            <input type="number" class="form-control" name="signup_num" value="{{$event->signup_num}}">
        </div>

        <button type="submit" class="btn btn-primary">修改</button>
    </form>

@stop



