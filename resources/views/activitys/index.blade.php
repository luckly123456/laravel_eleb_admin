@extends('layout.app')

@section('contents')
    <h1>活动</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>活动名称</th>
            <th>活动详情</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->content }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>
                    <a href="{{ route('activitys.edit',[$activity]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('activitys.destroy',[$activity]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$activitys->links()}}
    <a href="{{route('activitys.create')}}" >添加活动</a>
@stop



