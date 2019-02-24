@extends('layout.app')

@section('contents')
    <h1>商家添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('shops.update',[$shop])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">店铺名称</label>
            <input type="text" class="form-control" name="shop_name" value="{{$shop->shop_name}}">
        </div>
        <div class="form-group">
            <label>所属分类</label>
            <select name="shop_category_id" class="form-control" style="width: 200px">
                @foreach($shopcategories as $shopcategorie)
                    <option value="{{ $shopcategorie->id }}"
                            @if(old('$shopcategorie')==$shopcategorie->id) selected @endif
                    >{{ $shopcategorie->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>店铺图片</label>
            <img src="{{$shop->shop_img}}" width="50">
            <input type="file" name="shop_img">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">评分</label>
            <input type="number" class="form-control" name="shop_rating" value="{{$shop->shop_rating}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否是品牌</label>
            <input name="brand" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>是
            <input name="brand" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>否

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否准时送达</label>
            <input name="on_time" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>是
            <input name="on_time" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否蜂鸟配送</label>
            <input name="fengniao" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>是
            <input name="fengniao" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否保标记</label>
            <input name="bao" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>是
            <input name="bao" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否票标记</label>
            <input name="piao" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>是
            <input name="piao" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否准标记</label>
            <input name="zhun" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>是
            <input name="zhun" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">起送金额</label>
            <input type="number" class="form-control" name="start_send" value="{{$shop->start_send}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">配送费</label>
            <input type="number" class="form-control" name="send_cost" value="{{$shop->send_cost}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">店公告</label>
            <input type="text" class="form-control" name="notice" value="{{$shop->notice}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">优惠信息</label>
            <input type="text" class="form-control" name="discount" value="{{$shop->discount}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	状态</label>
            <input name="status" type="radio" value="1" @if(old('brand')??$shop->brand==1) checked @endif/>正常
            <input name="status" type="radio" value="0" @if(old('brand')??$shop->brand==0) checked @endif/>禁用
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



