@extends('layout.app')

@section('contents')
    <h1>会员表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>会员名</th>
            <th>电话</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>{{ $member->status==0?'正常':'禁用' }}</td>
                <td>
                    <a href="{{ route('members.status',[$member]) }}" class="btn btn-warning">状态修改</a>
                    <a href="{{ route('members.edit',[$member]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('members.destroy',[$member]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$members->links()}}
    <a href="{{route('members.create')}}" >添加会员</a>
@stop



