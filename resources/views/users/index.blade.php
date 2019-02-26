@extends('layout.app')

@section('contents')
    <h1>商家表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status==1?'启用':'禁用' }}</td>
                <td>{{ $user->shop->shop_name }}</td>0
                <td>
                    <a href="{{ route('users.reset',[$user]) }}" class="btn btn-warning">重置密码</a>
                    <a href="{{ route('users.edit',[$user]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('users.destroy',[$user]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->links()}}
    <a href="{{route('users.create')}}" >添加商家</a>
@stop



