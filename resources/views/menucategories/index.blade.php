@extends('layout.app')

@section('contents')
    <h1>商品分类表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>分类名</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menucategories as $menucategorie)
            <tr>
                <td>{{ $menucategorie->id }}</td>
                <td>{{ $menucategorie->name }}</td>
                <td>{{ $menucategorie->type_accumulation }}</td>
                <td>{{ $menucategorie->shop->shop_name }}</td>
                <td>{{ $menucategorie->description }}</td>
                <td>{{ $menucategorie->is_selected==1?'是':'否' }}</td>
                <td>
                    <a href="{{ route('menucategories.edit',[$menucategorie]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('menucategories.destroy',[$menucategorie]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menucategories->links()}}
    <a href="{{route('menucategories.create')}}" >添加商品分类</a>
@stop



