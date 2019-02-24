@extends('layout.app')

@section('contents')
    <h1>分类添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('shopcategories.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">分类名</label>
            <input type="text" class="form-control" name="name" placeholder="请输入分类名">
        </div>
        <div class="form-group">
            <label>分类状态:
                <input name="status" type="radio" value="1" />上架
                <input name="status" type="radio" value="0" />下架
            </label>
        </div>
        <div class="form-group">
            <label>图片上传</label>
            <input type="file" name="img">
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



