@extends('layout.app')

@section('contents')
    <h1>管理员添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input type="text" class="form-control" name="name" placeholder="请输入商家名">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">密码</label>
            <input type="password" class="form-control" name="password" placeholder="请输入密码">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="email" class="form-control" name="email" placeholder="请输入邮箱">
        </div>
        <div>
            @foreach($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->name}}"> {{$role->name}}</label>

            @endforeach

        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



