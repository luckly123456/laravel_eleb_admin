@extends('layout.app')

@section('contents')
    <h1>权限表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>角色名称</th>
            <th>角色描述</th>
            <th>操作</th>
        </tr>


    @foreach($permissions as $permission)
        <tr>
            <td>{{$permission->id}}</td>
            <td>{{$permission->name}}</td>
            <td>{{$permission->guard_name}}</td>
            <td>
                <a href="{{ route('permissions.edit',[$permission]) }}" class="btn btn-warning">编辑</a>
                <form style="display: inline" method="post" action="{{ route('permissions.destroy',[$permission]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>

    {{$permissions->links()}}

@stop



