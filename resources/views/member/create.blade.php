@extends('layout.app')

@section('contents')
    <h1>会员添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('members.store')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">会员名</label>
            <input type="text" class="form-control" name="username" placeholder="请输入商家名">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">密码</label>
            <input type="password" class="form-control" name="password" placeholder="请输入密码">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">确认密码</label>
            <input type="password" class="form-control" name="password2" placeholder="请确认密码">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">电话</label>
            <input type="tel" class="form-control" name="tel" placeholder="请输入电话">
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



