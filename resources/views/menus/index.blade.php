@extends('layout.app')

@section('contents')
    <h1>我的商品分类表</h1>
    <h3></h3>


    <form class="form-inline" action="{{route('menus.index')}}">
        搜索
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">keyword</label>
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="关键字">
        </div><div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">goods_price1</label>
            <input type="number" class="form-control" id="exampleInputEmail3" placeholder="最低价">
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3">goods_price2</label>
            <input type="number" class="form-control" id="exampleInputPassword3" placeholder="最高价">
        </div>

        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->goods_name }}</td>
                <td>{{ $menu->rating }}</td>
                <td>{{ $menu->menucategorie->name }}</td>
                <td>{{ $menu->goods_price }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->month_sales }}</td>
                <td>{{ $menu->rating_count }}</td>
                <td>{{ $menu->tips }}</td>
                <td>{{ $menu->satisfy_count }}</td>
                <td>{{ $menu->satisfy_rate }}</td>
                <td><img src="{{ $menu->goods_img }}" width="50"></td>
                <td>{{ $menu->status == 1?'上架':'下架'  }}</td>
                <td>
                    <a href="{{ route('menus.edit',[$menu]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('menus.destroy',[$menu]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menus->links()}}
    <a href="{{route('menus.create')}}" >添加菜品</a>
@stop



