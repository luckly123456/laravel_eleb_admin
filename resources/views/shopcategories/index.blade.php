@extends('layout.app')

@section('contents')
    <h1>商品分类表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>分类名</th>
            <th>图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shopcategories as $shopcategorie)
            <tr>
                <td>{{ $shopcategorie->id }}</td>
                <td>{{ $shopcategorie->name }}</td>
                <td><img src="{{$shopcategorie->img}}" width="50"></td>
                <td>{{ $shopcategorie->status }}</td>
                <td>
                    <a href="{{ route('shopcategories.edit',[$shopcategorie]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('shopcategories.destroy',[$shopcategorie]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$shopcategories->links()}}
    <a href="{{route('shopcategories.create')}}" >添加商品分类</a>
@stop



