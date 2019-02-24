@extends('layout.app')

@section('contents')
    <h1>修改分类</h1>
    @include('layout._errors')
    <form method="post" action="{{route('shopcategories.update',[$shopcategorie])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">分类名</label>
            <input type="text" class="form-control" name="name" value="{{ $shopcategorie->name }}">
        </div>
        <div class="form-group">
            <label>分类状态:
                <input name="status" type="radio" value="1" />上架
                <input name="status" type="radio" value="0" />下架
            </label>
        </div>
        <div class="form-group">
            <label>图片上传</label>
            <img src="{{\Illuminate\Support\Facades\Storage::url($shopcategorie->img)}}" alt="">
            <input type="file" name="img">
        </div>
        <button type="submit" class="btn btn-primary">修改</button>
    </form>

@stop



