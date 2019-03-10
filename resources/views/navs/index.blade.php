@extends('layout.app')

@section('contents')
    <h1>菜单列表</h1>
    @include('layout._errors')
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>url</th>
            <th>permission_id</th>
            <th>父id</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{ $nav->id }}</td>
                <td>{{ $nav->name }}</td>
                <td>{{ $nav->url }}</td>
                <td>{{ $nav->permission_id }}</td>
                <td>{{ $nav->pid }}</td>
                <td>
                    <a href="{{ route('navs.edit',[$nav]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('navs.destroy',[$nav]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$navs->links()}}

@stop




