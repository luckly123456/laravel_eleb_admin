@extends('layout.app')
@section('contents')
    <h1>修改管理员</h1>
    @include('layout._errors')
    <form method="post" action="{{route('admins.update',[$admin])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" class="form-control" name="name" value="{{$admin->name}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="email" class="form-control" name="email" value="{{$admin->email}}">
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



