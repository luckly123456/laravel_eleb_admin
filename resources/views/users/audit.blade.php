@extends('layout.app')

@section('contents')
    <h1>商家待审核表表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>所属商家</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->shop->shop_id }}</td>
                <td>待审核</td>
                <td>
                    <a href="{{ route('users.check',[$user]) }}" class="btn btn-warning">审核</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->links()}}
@stop



