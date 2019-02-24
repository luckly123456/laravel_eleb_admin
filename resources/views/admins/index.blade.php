@extends('layout.app')

@section('contents')
    <h1>管理员表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <a href="{{ route('admins.edit',[$admin]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('admins.destroy',[$admin]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$admins->links()}}
    <a href="{{route('admins.create')}}" >添加管理员</a>
@stop



