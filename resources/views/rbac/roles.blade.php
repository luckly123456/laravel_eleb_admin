@extends('layout.app')

@section('contents')
    <h1>商家表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>角色名称</th>
            <th>角色描述</th>
            <th>操作</th>
        </tr>

    @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->guard_name}}</td>
            <td>
                <a href="{{ route('roles.edit',[$role]) }}" class="btn btn-warning">编辑</a>
                <form style="display: inline" method="post" action="{{ route('roles.destroy',[$role]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
    {{$roles->links()}}
@stop



