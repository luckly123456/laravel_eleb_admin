@extends('layout.app')

@section('contents')
    <h1>活动</h1>
    <form class="form-inline" action="{{route('activitys.index')}}">
        <div class="form-group">
            <label>搜索</label>
            <select name="keyword" class="form-control" style="width: 200px">
                    <option value="0">所有</option>
                    <option value="1">未开始</option>
                    <option value="2">进行中</option>
                    <option value="3">已结束</option>
            </select>
            <button type="submit" class="btn btn-primary">搜索</button>
        </div>
    </form>
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
                <td>{!! $activity->content !!}</td>
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



