@extends('layout.app')

@section('contents')
    <h1>会员表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->content }}</td>
                <td>{{ date('Y-m-d',$event->signup_start) }}</td>
                <td>{{ date('Y-m-d',$event->signup_end) }}</td>
                <td>{{ $event->prize_date }}</td>
                <td>{{ $event->signup_num }}</td>
                <td>{{ $event->is_prize==0?'未开奖':'已开奖' }}</td>
                <td>
                    <a href="{{ route('events.mans',[$event]) }}" class="btn btn-warning">已报名人数</a>
                    <a href="{{ route('events.show',[$event]) }}" class="btn btn-warning">详情</a>
                    <a href="{{ route('events.edit',[$event]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('events.destroy',[$event]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$events->links()}}
    <a href="{{route('events.create')}}" >添加活动</a>
@stop



