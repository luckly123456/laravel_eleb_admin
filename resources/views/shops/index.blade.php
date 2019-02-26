@extends('layout.app')

@section('contents')
    <h1>商家表</h1>
    <table class="table table-bordered">
        <tr>
            <th>序号</th>
            <th>分类</th>
            <th>名称</th>
            <th>图片</th>
            <th>评分</th>
            <th>品牌</th>
            <th>准时</th>
            <th>配送</th>
            <th>保标</th>
            <th>发票</th>
            <th>准标</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>公告</th>
            <th>优惠</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->id }}</td>
                <td>{{ $shop->shopcategorie->name }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td><img src="{{$shop->shop_img}}" width="50"></td>
                <td>{{ $shop->shop_rating }}</td>
                <td>{{ $shop->brand ==1?'是':'否' }}</td>
                <td>{{ $shop->on_time ==1?'是':'否' }}</td>
                <td>{{ $shop->fengniao ==1?'是':'否' }}</td>
                <td>{{ $shop->bao ==1?'是':'否' }}</td>
                <td>{{ $shop->piao ==1?'是':'否' }}</td>
                <td>{{ $shop->zhun ==1?'是':'否' }}</td>
                <td>{{ $shop->start_send }}</td>
                <td>{{ $shop->send_cost }}</td>
                <td>{{ $shop->notice }}</td>
                <td>{{ $shop->discount }}</td>
                <td>{{ $shop->status ==1?'启用':'禁用' }}</td>
                <td>
                    <a href="{{ route('shops.edit',[$shop]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('shops.destroy',[$shop]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
{{$shops->links()}}
<a href="{{route('shops.create')}}" >添加商家</a>
@stop



