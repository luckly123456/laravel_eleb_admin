@extends('layout.app')
@section('contents')
    <h1>修改管理员密码</h1>
    @include('layout._errors')
    <form method="post" action="{{route('admins.resetped',[$admin])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h3>管理员用户名:  {{$admin->name}}</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">密码</label>
            <input type="password" class="form-control" name="password" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">确认密码</label>
            <input type="password" class="form-control" name="password2" >
        </div>

        <button type="submit" class="btn btn-primary">修改</button>
    </form>

@stop



